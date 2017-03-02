<form action="" method="post" id="lte-hs-slide-form">

    <table class="form-table">

        <tbody>

        <tr class="form-field">
            <th>
                <label for="lte-hs-slide-url">Slajd:</label>
            </th>
            <td>
                <a class="button-secondary" id="select-slide-btn">Wybierz slajd z biblioteki mediów</a>
                <input type="hidden" name="entry[slide_url]" id="lte-hs-slide-url" value="" />

                <p class="description">To pole jest wymagane</p>
                <p id="slide-preview"></p>


            </td>
        </tr>

        <tr class="form-field">
            <th>
                <label for="lte-hs-title">Tytuł:</label>
            </th>
            <td>
                <input type="text" name="entry[title]" id="lte-hs-title" value="" />

                <p class="description">To pole jest wymagane</p>

            </td>
        </tr>

        <tr class="form-field">
            <th>
                <label for="lte-hs-caption">Podpis:</label>
            </th>
            <td>
                <input type="text" name="entry[caption]" id="lte-hs-caption" value="" />

                <p class="description">To pole jest opcjonalne</p>

            </td>
        </tr>

        <tr class="form-field">
            <th>
                <label for="lte-hs-read-more-url">Link "Czytaj więcej":</label>
            </th>
            <td>
                <input type="text" name="entry[read_more_url]" id="lte-hs-read-more-url" value="" />

                <p class="description">To pole jest opcjonalne</p>

            </td>
        </tr>

        <tr>
            <th>
                <label for="lte-hs-position">Pozycja:</label>
            </th>
            <td>
                <input type="text" name="entry[position]" id="lte-hs-position" value="" />
                <a class="button-secondary" id="get-last-pos">Pobierz ostatnią wolną pozycję</a>

                <p id="post-info" class="description">To pole jest wymagane</p>

            </td>
        </tr>

        <tr>
            <th>
                <label for="lte-hs-published">Opublikowany:</label>
            </th>
            <td>
                <input type="checkbox" name="entry[published]" id="lte-hs-published" value="yes" />
            </td>
        </tr>

        </tbody>

    </table>

    <p class="submit">
        <a href="#" class="button-secondary">Wstecz</a>
        &nbsp;
        <input type="submit" class="button-primary" value="Zapisz zmiany" />
    </p>

</form>