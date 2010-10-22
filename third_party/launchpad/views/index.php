<style type="text/css">
    .fullwidth {
        width:100%;
    }
</style>

<?php
	$this->table->set_template($cp_table_template);
	$this->table->set_heading(array(
			array('data' => lang('setting'), 'width' => '50%'),
			lang('current_value')
		)
	);
?>

<?=form_open($_form_base.'&method=save_settings')?>

	<?php

        $this->table->add_row(array(
                lang('title', 'launchpad_title'),
                form_error('launchpad_title').
                form_input('launchpad_title', set_value('launchpad_title', $launchpad_title), 'id="launchpad_title"')
            )
        );

        $this->table->add_row(array(
                lang('body', 'launchpad_body'),
                form_error('launchpad_body').
                form_textarea('launchpad_body', set_value('launchpad_body', $launchpad_body), 'id="launchpad_body"')
            )
        );

        $this->table->add_row(array(
                lang('rss_feed_url', 'launchpad_rss_feed'),
                form_error('launchpad_rss_feed').
                form_input('launchpad_rss_feed', set_value('launchpad_rss_feed', $launchpad_rss_feed), 'id="launchpad_rss_feed"')
            )
        );

        $this->table->add_row(array(
                lang('use_feedburner_for_mail', 'launchpad_use_feedburner_for_mail'),
                form_error('launchpad_use_feedburner_for_mail').
                form_checkbox('launchpad_use_feedburner_for_mail', 'y', ($launchpad_use_feedburner_for_mail == 'y'))
            )
        );

        $this->table->add_row(array(
                lang('be_nice', 'launchpad_be_nice'),
                form_error('launchpad_be_nice').
                form_checkbox('launchpad_be_nice', 'y', ($launchpad_be_nice == 'y'))
            )
        );


		echo $this->table->generate();
	?>
	<p>
		<?=form_submit(array('name' => 'submit', 'value' => lang('update'), 'class' => 'submit'))?>
	</p>

<?=form_close()?>

<?php
/* End of file index.php */
/* Location: ./system/expressionengine/third_party/seo_lite/views/index.php */