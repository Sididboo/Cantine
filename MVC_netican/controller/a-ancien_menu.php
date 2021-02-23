<?php

include_once '../model/contient.php';

$lesContenus = new Contient();
$ancienContenu = array();
$ancienContenu = $lesContenus->findAll();

?>

<tr>
    <thead class="thead-dark">
        <th>Date menu</th>
        <th>Nombre de convives</th>
        <th>Nom plat</th>
    </thead>
</tr>

<?php

    for ($i=0; $i < count($ancienContenu); $i++)
    {

        echo

        '<tr>'.

            
            '<td>'.
                $ancienContenu[$i]->get_leMenu()->get_dateMenu().
            '</td>'.

            '<td>'.
                $ancienContenu[$i]->get_leMenu()->get_nbConvive().
            '</td>'.

            '<td>'.
                $ancienContenu[$i]->get_lePlat()->get_nom().
            '</td>'.

        '</tr>';

    }


    $etat = "ancienMenu";

?>

</table>
</div>