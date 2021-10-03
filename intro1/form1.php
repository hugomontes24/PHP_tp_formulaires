<?php

/**
 * Etape 1 : Chargement des données
 * 
 */
$gender = array( 
            'mrs' => 'Madame',
            'mr' => 'Monsieur',
            'other' => 'Autre'
);


$hobbies = array(
        'games'=> 'Jeux vidéo',
        'music'=> 'Musique',
        'scrabble'=> 'Scrabble',
        'danse'=> 'Danse',
        'cinema'=> 'Cinema',
        'trekking'=> 'Randonnée' 
);

function formDataLoad($name) {
    if (!empty( $_POST[$name]) ){
        echo $_POST[$name];
    }
}


// traitement du formulaire


//tester les saisies si le formulaire a ete testé
// si la variable superglobale $_POST n'est pas vide
if( !empty( $_POST)) {

//chaque erreur une ligne du tableau
    $errors = array();
    


    /**
     * Tester la civilité :
     * la valeur postée doit faire partie des valeurs attendues
     * 
     * valeurs attendues : 'mrs','mister', 'other')
     * Solution : fonction in_arry($value,$array)
     * renvoie true si $value est une valeur de $array
     */
    
    if( 
        !isset( $_POST['gender'] ) 
        OR !in_array( $_POST['gender'], array_flip( $gender ))
    ) {
        $errors['gender'] = 'La civilité est obligatoire';
    }
// idem que pour civilité 
    if( empty ( $_POST['firstname']) ) {
        $errors['firstname'] = 'Le prénom est obligatoire.';
    }
    
    if( 
        empty ( $_POST['lastname'])) {
        $errors['lastname'] = 'Le nom est obligatoire.';
    }
    
    if( 
        empty ( $_POST['email']) 
        OR filter_var( $_POST['email'], FILTER_VALIDATE_EMAIL ) == false
        ) {
        $errors['email'] = 'L\'adresse email est obligatoire et doit être valide.';
    }

// tableau des valeurs possibles des hobbies

/**Comparer les valeurs envoyées à celles possibles (hobbies)
 * Si des cases sont cochees ,
 * $_POST['hobbies'] existe et contient un tableau dont les valeurs correspondent 
 * aux cases cochées.
 * Solution :  array_diff($arr1,$arr2)  renvoie un tableau contenant 
 * les valeurs $arr1 qui ne sont pas presentes dans $arr2 ou un 
 * tableau vide s'il n'y a pas des diff
 * Pour pouvoir comparer les valeurs de $_POST(hobbies) avec les clés de
 * ($hobbies) je dois utiliser array_flip pour inverser clés->valeurs.
 * 
 */
    if( 
        isset($_POST['hobbies']) 
        && !empty(array_diff($_POST['hobbies'], array_flip($hobbies)) )
    ) {
        $errors['hobbies'] = 'Ce choix n\'est pas proposé.'; 
        
    }


// // if (isset($errors['gender']) ) :var_dump($errors['gender']); echo '<br>'; endif;
// if(isset($_POST['lastname'])) : var_dump($_POST['lastname']);  echo '<br>'; endif ;
// if(isset($_POST['firstname'])) : var_dump($_POST['firstname']);  echo '<br>'; endif ;
// if(isset($errors['lastname'])) : var_dump($errors['lastname']);  echo '<br>'; endif ;
// if(isset($errors)) : var_dump($errors);  echo '<br>'; endif ;
// // var_dump(array_flip($hobbies));

}; // fin du test si le formulaire est posté

// inclure la vue
include 'form1.phtml';