<section class="panel panel-default">
	<?php /* Important, do not delete | Importante, No borrar */ ?>
	<?php if ( post_password_required() ) : ?>
		<div class="alert alert-warning">
			<?php _e( 'Esta publicación está protegida por contraseña. Ingresa la contraseña para ver los comentarios.', 'gb' ); ?>
		</div>
	<?php return; endif; ?>
	<?php /* You can edit after this comment | Puedes edotar después de este comentario */ ?>

	<?php if ( have_comments() ) : ?>
		<div class="panel-heading">
			<h3 class="comments-title">
				<?php printf( _n( 'Un comentario en %2$s', '%1$s comentarios en %2$s', get_comments_number(), 'gb' ), number_format_i18n( get_comments_number() ), '' . get_the_title() . '' ); ?>
			</h3>
		</div>

		<div class="panel-body">
			<ul class="comment-list media-list">
				<?php wp_list_comments( array( 'callback' => 'gb_comments', 'avatar_size' => 45) ); ?>
			</ul>

			<?php //echo get_comment_pages_count(); ?>

			<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>

				<div class="comment-pagination">
					<?php paginate_comments_links( ) ?>
				</div>

			<?php //endif; // check for comment navigation ?>
			<?php else:  // end ! comments_open() ?>
				<?php	if ( ! comments_open() ) : ?>
					<p><?php _e( 'Los comentarios están cerrados.', 'gb' ); ?></p>
				<?php endif; // end ! comments_open() ?>
			<?php endif; // end have_comments() ?>
		</div>
	<?php endif; ?>
		<?php
			/**
			 * Personalizar formulario
			 */
			$fields =  array(
				'author' => '<div class="form-group">
								<label for="author">Nombre</label><em>*</em>
								<input id="author" name="author" type="text" class="form-control" value="' . esc_attr( $commenter['comment_author'] ) . '" placeholder="' . __( 'Nombre' ) . '" '. ( $req ? 'required' : '' ) . ' />
							</div>',
				'email'  => '<div class="form-group">
								<label for="email">Correo electrónico</label><em>*</em>
								<input id="email" name="email" type="email" class="form-control" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" placeholder="' . __( 'Correo' ) . '" '. ( $req ? 'required' : '' ) . ' />
							</div>',
				'url'    => '<div class="form-group">
								<label for="url">Url</label>
								<input id="url" name="url" type="text" class="form-control" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" placeholder="' . __( 'Sitio Web' ) . '" />
							</div>',
			);
			$comment_field = '<textarea id="comment" class="form-control"  name="comment" cols="45" rows="8" placeholder="'. __( 'Escribe tu opinión', 'gb' ) . '" required></textarea>';
			?>
			<div class="panel panel-default">
				<div class="panel-heading text-center text-uppercase">
					<span class="h4">¿Y tú qué opinas?</span>
				</div>
				<div class="panel-body">
					<?php
					comment_form(
						array(
							'fields' => apply_filters( 'comment_form_default_fields', $fields ),
							'title_reply' => __('Deja tu comentario', 'gb'), // Change title
							'submit_button' => '<input name="%1$s" type="submit" id="%2$s" class="%3$s btn btn-default" value="%4$s" >', // Change button
							'comment_field' => $comment_field, // Change textarea
							'comment_notes_before' => '', // Delete notes before comment form
							'comment_notes_after' => '<span class="help-block">' . __( 'Por si acaso, tu email no se mostrará.', 'gb' ) . '</span>', // Edit notes after form
							)
						);
					?>
				</div>
			</div>
</section>