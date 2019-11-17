<div id="learn-press-certificates" class="no-design">
	<?php _e( 'Save certificate before editing!', 'learnpress-certificates' ); ?>
</div>
<script type="text/x-template" id="tmpl-certificates">
    <div id="learn-press-certificates" :class="{'has-template': !!template}">

		<?php include_once 'editor-toolbar.php'; ?>

        <div id="cert-design-view" :class="{'dragover': dragover}">
            <div id="cert-design-view-inside">
                <div id="cert-design-editor">
                    <img v-show="!!template" :src="template" class="cert-template"/>
                    <canvas></canvas>
                </div>
            </div>

			<?php include_once 'editor-no-template.php'; ?>
			<?php include_once 'editor-rulers.php'; ?>
        </div>
    </div>
</script>