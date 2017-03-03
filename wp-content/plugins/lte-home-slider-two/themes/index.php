
<form id="lte-hs-form1" method="get" action="">

    Sortuj według:
    <select name="sort_by">
        <option value="id">Identyfikatora</option>
        <option value="position">Pozycji</option>
        <option value="published">Widoczność</option>
    </select>


    <select name="order_dir">
        <option value="asc">Rosnąco</option>
        <option value="desc">Malejąco</option>
    </select>

    <input type="submit" class="button-secondary" value="Sortuj">

</form>

<form id="lte-hs-form2" method="post" action="">

    <div class="tablenav">
        <div class="action alignleft">

            <select name="bulkaction">
                <option value="0">Masowe działania</option>
                <option value="delete">Usuń</option>
                <option value="public">Publiczny</option>
                <option value="private">Prywatny</option>
            </select>

            <input type="submit" class="button-secondary" value="Zastosuj">
        </div>

        <div class="tablenav-pages">
            <span class="displaying-num"><?php echo $Pagination->getTotalSlides(); ?> slajdy</span>

            <?php
                $curr_page = $Pagination->getCurrPage();
                $last_page = $Pagination->getLastPage();

                $first_disabled ='';
                $last_disabled ='';

                $url_params = array(
                    'orderby' => $Pagination->getOrderBy(),
                    'orderdir' => $Pagination->getOrderDir()
                );

                $url_params['paged'] = 1;
                $first_page_url = $this->get_admin_url($url_params);

                $url_params['paged'] = $curr_page-1;
                $prev_page_url = $this->get_admin_url($url_params);

                $url_params['paged'] = $last_page;
                $last_page_url = $this->get_admin_url($url_params);

                $url_params['paged'] = $curr_page+1;
                $next_page_url = $this->get_admin_url($url_params);


                if($curr_page == 1){
                    $first_page_url = '#';
                    $prev_page_url = '#';
                    $first_disabled = 'disabled';
                }
                elseif($curr_page == $last_page){
                    $last_page_url = '#';
                    $next_page_url = '#';
                    $last_disabled = 'disabled';
                }

            ?>

            <span class="pagination-links">
            <a href="<?php echo $first_page_url; ?>" title="Idź do pierwszej strony" class="first-page <?php echo $first_disabled; ?>">«</a>&nbsp;&nbsp;
            <a href="<?php echo $prev_page_url; ?>" title="Idź do poprzedniej strony" class="prev-page <?php echo $first_disabled; ?>">‹</a>&nbsp;&nbsp;

            <span class="paging-input"><?php echo $curr_page; ?> z <span class="total-pages"> <?php echo $last_page; ?> </span></span>

            &nbsp;&nbsp;<a href="<?php echo $next_page_url; ?>" title="Idź do następnej strony" class="next-page <?php echo $last_disabled; ?>">›</a>
            &nbsp;&nbsp;<a href="<?php echo $last_page_url; ?>" title="Idź do ostatniej strony" class="last-page <?php echo $last_disabled; ?>">»</a>

            </span>
        </div>

    </div>



    <div class="clear"></div>

    <table class="widefat">
        <thead>
        <tr>
            <th class="check-column"><input type="checkbox" /></th>
            <th>ID</th>
            <th>Miniaturka</th>
            <th>Tytuł</th>
            <th>Opis</th>
            <th>Czytaj więcej</th>
            <th>Pozycja</th>
            <th>Widoczny</th>
        </tr>
        </thead>
        <tbody id="the-list">

        <?php if($Pagination->hasItems()): ?>

            <?php foreach ($Pagination->getItems() as $i => $item): ?>

                <tr <?php echo ($i%2 == 0) ? 'class="alternate"' : '' ?> >
                    <th class="check-column">
                        <input type="checkbox" value="1" name="bulkcheck[]">
                    </th>
                    <td><?php echo $item->id; ?></td>
                    <td>
                        Podgląd slajdu <br />
                        <img src="<?php echo $item->slide_url; ?>" alt="obrazek slajdu" />
                        <div class="row-actions">
                        <span class="edit">
                            <a class="edit" href="">Edytuj</a>
                        </span> |
                            <span class="trash">
                            <a class="delete" href="" onclick="return confirm('Czy na pewno chcesz usunąć ten wpis?')">Usuń</a>
                        </span>
                        </div>
                    </td>
                    <td><?php echo $item->title; ?></td>
                    <td><?php echo $item->caption; ?></td>
                    <td><a href="<?php echo $item->read_more_url; ?>" >Czytaj więcej</a> </td>
                    <td><?php echo $item->position; ?></td>
                    <td><?php echo $item->published == 'yes' ? 'TAK' : 'NIE'; ?></td>
                </tr>



            <?php endforeach; ?>

        <?php else: ?>
            <tr>
                <td colspan="8">Brak slajdów w bazie danych</td>
            </tr>
        <?php endif; ?>

        </tbody>
    </table>

    <div class="tablenav">
        <div class="tablenav-pages">

            <span class="pagination-links">
                Przejdź do strony
                <?php

                $url_params = array(
                    'orderby' => $Pagination->getOrderBy(),
                    'orderdir' => $Pagination->getOrderDir()
                );

                for($i=1; $i<=$Pagination->getLastPage(); $i++){

                    $url_params['paged'] = $i;
                    $url = $this->get_admin_url($url_params);

                    if($i == $Pagination->getCurrPage()){
                        echo "&nbsp;<strong>{$i}</strong>";
                    }else{
                        echo '&nbsp;<a href="'.$url.'">'.$i.'</a>';
                    }

                }
                ?>

            </span>

        </div>

        <div class="clear"></div>
    </div>

</form>

