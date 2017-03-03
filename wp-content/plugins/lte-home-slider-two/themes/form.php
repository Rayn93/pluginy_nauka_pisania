<?php

$action_params = array('view' => 'form', 'action' => 'save');

if($slide->has_id()){
    $action_params['slideid'] = $slide->get_field('id');
}



?>


<form action="<?php echo $this->get_admin_url($action_params); ?>" method="post" id="lte-hs-slide-form">

    <table class="form-table">

        <tbody>

        <tr class="form-field">
            <th>
                <label for="lte-hs-slide-url">Slajd:</label>
            </th>
            <td>
                <a class="button-secondary" id="select-slide-btn">Wybierz slajd z biblioteki mediów</a>
                <input type="hidden" name="entry[slide_url]" id="lte-hs-slide-url" value="<?php echo $slide->get_field('slide_url'); ?>" />

                <?php if($slide->hasError('slide_url')): ?>
                    <p class="description error"><?php echo $slide->getError('slide_url'); ?></p>
                <?php else: ?>
                    <p class="description">To pole jest wymagane</p>
                <?php endif ?>
                <p id="slide-preview"></p>

                <?php if($slide->get_field('slide_url') != NULL ): ?>
                    <img src="<?php echo $slide->get_field('slide_url');?>" alt="slajd" >
                <?php endif; ?>


            </td>
        </tr>

        <tr class="form-field">
            <th>
                <label for="lte-hs-title">Tytuł:</label>
            </th>
            <td>
                <input type="text" name="entry[title]" id="lte-hs-title" value="<?php echo $slide->get_field('title'); ?>" />

                <?php if($slide->hasError('title')): ?>
                    <p class="description error"><?php echo $slide->getError('title'); ?></p>
                <?php else: ?>
                    <p class="description">To pole jest wymagane</p>
                <?php endif ?>

            </td>
        </tr>

        <tr class="form-field">
            <th>
                <label for="lte-hs-caption">Podpis:</label>
            </th>
            <td>
                <input type="text" name="entry[caption]" id="lte-hs-caption" value="<?php echo $slide->get_field('caption'); ?>" />

                <?php if($slide->hasError('caption')): ?>
                    <p class="description error"><?php echo $slide->getError('caption'); ?></p>
                <?php else: ?>
                    <p class="description">To pole jest opcjonalne</p>
                <?php endif ?>

            </td>
        </tr>

        <tr class="form-field">
            <th>
                <label for="lte-hs-read-more-url">Link "Czytaj więcej":</label>
            </th>
            <td>
                <input type="text" name="entry[read_more_url]" id="lte-hs-read-more-url" value="<?php echo $slide->get_field('read_more_url'); ?>" />

                <?php if($slide->hasError('read_more_url')): ?>
                    <p class="description error"><?php echo $slide->getError('read_more_url'); ?></p>
                <?php else: ?>
                    <p class="description">To pole jest opcjonalne</p>
                <?php endif ?>

            </td>
        </tr>

        <tr>
            <th>
                <label for="lte-hs-position">Pozycja:</label>
            </th>
            <td>
                <input type="text" name="entry[position]" id="lte-hs-position" value="<?php echo $slide->get_field('position'); ?>" />
                <a class="button-secondary" id="get-last-pos">Pobierz ostatnią wolną pozycję</a>

                <?php if($slide->hasError('position')): ?>
                    <p id="post-info" class="description error"><?php echo $slide->getError('position'); ?></p>
                <?php else: ?>
                    <p id="post-info" class="description">To pole jest wymagane</p>
                <?php endif ?>


            </td>
        </tr>

        <tr>
            <th>
                <label for="lte-hs-published">Opublikowany:</label>
            </th>
            <td>
                <input type="checkbox" name="entry[published]" id="lte-hs-published" value="yes" <?php echo($slide->is_published() ? 'checked' : '');  ?> />
            </td>
        </tr>

        </tbody>

    </table>

    <p class="submit">
        <a href="<?php echo $this->get_admin_url(array('view' => 'index')); ?>" class="button-secondary">Wstecz</a>
        &nbsp;
        <input type="submit" class="button-primary" value="Zapisz zmiany" />
    </p>

</form>