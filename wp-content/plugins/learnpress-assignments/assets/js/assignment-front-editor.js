;(function ($) {
    "use strict";
    var __X = $.extend({}, FE_Base.Store_Methods, {
        loadSettings: function (callback) {
            var that = this;
            return;
            //if ($.isEmptyObject(this.item.item.settings)) {
            this.request('', 'load-item-settings', {
                item_ID: this.itemData.id,
                item_type: this.itemData.type
            }).then(function (response) {
                $.isFunction(callback) && callback.apply(that, [response])
            });
            // }
        },
        includeFormField: function (field) {
            var maps = {
                number: 'text'
            }, slug = field.type.replace(/_/, '-');

            if (maps[slug]) {
                field.xType = slug;
                field.type = maps[slug];
            } else {
                field.type = slug;
            }
            return 'e-form-field-' + field.type
        },
        redraw: function () {
            var vm = this;
            vm.drawComponent = false;
            Vue.nextTick(function () {
                vm.drawComponent = true;
            });
        },

        vueId: function () {
            return this._uid
        },

        getSettings: function (key) {
            return key && this.itemData.settings ? this.itemData.settings[key] : this.itemData.settings;
        },

        getFields: function (type) {
            var $postTypeFields = this.$dataStore().post_type_fields;

            return $postTypeFields[type];
        },

        loadSettingsCallback: function (response) {
            var content = response.__CONTENT__;

            delete response['__CONTENT__'];

            this.itemData.settings = response;
            this.itemData.content = content;

        },

        isEmptySettings: function () {
            var s = this.itemData.settings;
            return !s || ($.isPlainObject(s) && $.isEmptyObject(s)) || ($.isArray(s) && s.length === 0);
        }
    });
    var __A = {
        template: '#tmpl-e-course-item-settings-lp_assignment',
        props: ['item', 'itemData', 'request'],
        data: function () {
            return {
                drawComponent: true,
                settings: this.itemData.settings || {}
            }
        },
        computed: {
            settings: function () {
                return this.itemData.settings || {};
            }
        },
        watch: {
            // itemData: {
            //     handler: function (val) {
            //         console.log('Load Settings');
            //
            //         if (this.isEmptySettings()) {
            //             setTimeout(function ($i) {
            //                 $i.loadSettings($i.loadSettingsCallback);
            //                 $i.redraw();
            //             }, 70, this);
            //         } else {
            //             this.redraw();
            //         }
            //         return val;
            //     },
            //     deep: true
            // },
            'itemData.id': function () {
                console.log('redra')
                this.redraw();
            }
        },

        created: function () {
            this.loadSettings(this.loadSettingsCallback);
        },
        methods: $.extend({}, __X, {})
    }
    Vue.component('e-item-settings-lp_assignment', __A);

    Vue.component('e-form-field-file-advanced', {
        template: '#tmpl-e-form-field-file-advanced',
        props: ['item', 'itemData', 'request', 'field', 'settings'],
        data: function () {
            return {
                drawComponent: true,
                attachments: [] // Pull from DB, each item is an object like {id: 1234, title: 'Title 1', ...}
            }
        },
        computed: {
            attach: {
                get: function (value) {
                    return this.itemData.settings[this.field.id];
                },
                set: function (v) {
                    this.itemData.settings[this.field.id] = v;
                }
            }
        },
        created: function () {
        },
        mounted: function () {

            var $vm = this;

            this.fetchAttachments();

            // Media selector
            this.mediaFrame = wp.media.frames.file_frame = wp.media({
                title: $(this).data('uploader_title'),
                button: {
                    text: $(this).data('uploader_button_text')
                },
                multiple: true
            }).on('select', function () {
                var attachments = [],
                    selection = $vm.mediaFrame.state().get('selection').toJSON(),
                    attachmentIds = [],
                    i, n = selection.length;

                for (i = 0; i < n; i++) {
                    if ($vm.hasAttachment(attachments, selection[i].id)) {
                        continue;
                    }
                    attachments.push({
                        id: selection[i].id,
                        title: selection[i].title,
                        url: selection[i].url,
                        icon: selection[i].icon,
                        filename: selection[i].filename
                        // Other field...
                    });

                    attachmentIds.push(selection[i].id);
                }

                Vue.set($vm.itemData.settings, $vm.field.id, attachmentIds);
                $vm.attachments = attachments;

            }).on('open', function () {
                var selection = $vm.mediaFrame.state().get('selection'),
                    attachmentIds = $vm.itemData.settings[$vm.field.id],
                    attachment, i, n = attachmentIds.length;

                for (i = 0; i < n; i++) {
                    attachment = wp.media.attachment(attachmentIds[i]);
                    attachment.fetch();
                    selection.add(attachment ? [attachment] : []);
                }
            });

        },
        methods: {
            hasAttachment: function (attachments, id) {
                return attachments.findIndex(function (a) {
                        return a.id == id
                    }) !== -1;
            },
            fetchAttachments: function () {
                var $vm = this,
                    ids = this.itemData.settings[this.field.id] || [],
                    attachments = [], attachment;

                if (!$.isArray(ids)) {
                    ids = (ids + '').split(' ');
                }

                // Convert item to int
                ids = ids.map(function (a) {
                    return parseInt(a)
                });

                // Remove duplicate items
                ids = ids.filter(function (a, pos) {
                    var eq = ids.indexOf(a) == pos;
                    if(eq){
                        attachment = wp.media.attachment(a);
                        attachment.fetch().done(function (r) {
                            $vm.attachments.push({
                                id: r.id,
                                url: r.url,
                                filename: r.filename,
                                icon: r.icon,
                                title: r.title
                            });
                        });
                    }console.log($vm);
                    return eq;
                });

                Vue.set(this.itemData.settings, this.field.id, ids);

                return ids;
            },
            redraw: function () {
                var vm = this;
                vm.drawComponent = false;
                Vue.nextTick(function () {
                    vm.drawComponent = true;
                });
            },
            _selectMedia: function (e) {
                e.preventDefault();

                this.mediaFrame.open();
            }
        }
    })
    ;
})
(jQuery);