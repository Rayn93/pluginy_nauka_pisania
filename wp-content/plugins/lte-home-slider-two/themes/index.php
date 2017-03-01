
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
            <span class="displaying-num">4 slajdy</span>

            <span class="pagination-links">
            <a href="" title="Idź do pierwszej strony" class="first-page disabled">«</a>&nbsp;&nbsp;
            <a href="" title="Idź do poprzedniej strony" class="prev-page disabled">‹</a>&nbsp;&nbsp;

            <span class="paging-input">1 z <span class="total-pages"> 4 </span></span>

            &nbsp;&nbsp;<a href="" title="Idź do następnej strony" class="next-page">›</a>
            &nbsp;&nbsp;<a href="" title="Idź do ostatniej strony" class="last-page ">»</a>

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
            <tr>
                <td colspan="8">Brak slajdów w bazie danych</td>
            </tr>

            <tr>
                <th class="check-column">
                    <input type="checkbox" value="1" name="bulkcheck[]">
                </th>
                <td>1</td>
                <td>
                    Podgląd slajdu
                    <div class="row-actions">
                        <span class="edit">
                            <a class="edit" href="">Edytuj</a>
                        </span> |
                        <span class="trash">
                            <a class="delete" href="" onclick="return confirm('Czy na pewno chcesz usunąć ten wpis?')">Usuń</a>
                        </span>
                    </div>
                </td>
                <td>Jakiś tutuł slajdu</td>
                <td>Opis slajdu</td>
                <td>www.robertsaternus.pl</td>
                <td>1</td>
                <td>tak</td>
            </tr>

            <tr class="alternate">
                <th class="check-column">
                    <input type="checkbox" value="1" name="bulkcheck[]">
                </th>
                <td>1</td>
                <td>
                    Podgląd slajdu
                    <div class="row-actions">
                        <span class="edit">
                            <a class="edit" href="">Edytuj</a>
                        </span> |
                        <span class="trash">
                            <a class="delete" href="" onclick="return confirm('Czy na pewno chcesz usunąć ten wpis?')">Usuń</a>
                        </span>
                    </div>
                </td>
                <td>Jakiś tutuł slajdu</td>
                <td>Opis slajdu</td>
                <td>www.robertsaternus.pl</td>
                <td>1</td>
                <td>tak</td>
            </tr>


        </tbody>
    </table>

    <div class="tablenav">
        <div class="tablenav-pages">

            <span class="pagination-links">
                Przejdź do strony
                <strong>1</strong>
                <a href="#">2</a>
                <a href="#">3</a>

            </span>

        </div>

        <div class="clear"></div>
    </div>

</form>

