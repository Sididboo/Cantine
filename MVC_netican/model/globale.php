<?php

    /*                          
        Class Globale en construction ...
    */

    class Globale
    {
        // propriétées
        public static $listCategoriesIngredients, 
                        $listCategoriesPlats,
                        $listCategoriesTickets,
                        $listCommerces,
                        $listIngredients,
                        $listMarques,
                        $listPays,
                        $listPlats,
                        $listProduits,
                        $listProduitsAchetes,
                        $listSousCategoriesIngredients,
                        $listTickets,
                        $listTypesConditionnements,
                        $listUnites = array();

        // Getters
        public static function getListCategoriesIngredients()
        {
            include_once 'categoriesIngredients.php';

            $laCategorieIngredient = new CategoriesIngredients();
            self::$listCategoriesIngredients = $laCategorieIngredient->findAll();

            return self::$listCategoriesIngredients;
        }

        public static function getListCategoriesPlats()
        {
            return self::$listCategoriesPlats;
        }

        public static function getListCategoriesTickets()
        {
            return self::$listCategoriesTickets;
        }

        public static function getListCommerces()
        {
            return self::$listCommerces;
        }

        public static function getListIngredients()
        {
            return self::$listIngredients;
        }

        public static function getListMarques()
        {
            return self::$listMarques;
        }

        public static function getListPays()
        {
            if (self::$listPays == null) 
            {
                echo 'null';
                include_once 'pays.php';

                $lePays = new Pays();
                self::$listPays = $lePays->findAll();
            }
            
            return self::$listPays;
        }

        public static function getListPlats()
        {
            return self::$listPlats;
        }

        public static function getListProduits()
        {
            return self::$listProduits;
        }

        public static function getListProduitsAchetes()
        {
            return self::$listProduitsAchetes;
        }

        public static function getListSousCategoriesIngredients()
        {
            return self::$listSousCategoriesIngredients;
        }

        public static function getListTickets()
        {
            return self::$listTickets;
        }

        public static function getListTypesConditionnements()
        {
            return self::$listTypesConditionnements;
        }

        public static function getListUnites()
        {
            return self::$listUnites;
        }

        // Setters
        public static function setListCategoriesIngredients()
        {
            include_once 'categoriesIngredients.php';

            $laCategorieIngredient = new CategoriesIngredients();
            self::$listCategoriesIngredients = $laCategorieIngredient->findAll();
        }
        public static function setListCategoriesPlats()
        {
            include_once 'categoriesPlats.php';

            $laCategoriePlat = new CategoriesPlats();
            self::$listCategoriesPlats = $laCategoriePlat->findAll();
        }
        public static function setListCategoriesTickets()
        {
            include_once 'categoriesTickets.php';

            $laCategoriesTickets = new CategoriesTickets();
            self::$listCategoriesTickets = $laCategoriesTickets->findAll();
        }
        public static function setListCommerces()
        {
            include_once 'commerces.php';

            $leCommerce = new Commerces();
            self::$listCommerces = $leCommerce->findAll();
        }
        public static function setListIngredients()
        {
            include_once 'ingredients.php';

            $leIngredient = new Ingredients();
            self::$listIngredients = $leIngredient->findAll();
        }
        public static function setListMarques()
        {
            include_once 'marques.php';

            $laMarque = new Marques();
            self::$listMarques = $laMarque->findAll();
        }
        public static function setListPays()
        {
            include_once 'pays.php';

            $lePays = new Pays();
            self::$listPays = $lePays->findAll();
        }
        public static function setListPlats()
        {
            include_once 'plats.php';

            $lePlat = new Plats();
            self::$listPlats = $lePlat->findAll();
        }
        public static function setListProduits()
        {
            include_once 'produits.php';

            $leProduit = new Produits();
            self::$listProduits = $leProduit->findAll();
        }
        public static function setListProduitsAchetes()
        {
            include_once 'produitsAchetes.php';

            $leProduitAchete = new ProduitsAchetes();
            self::$listProduitsAchetes = $leProduitAchete->findAll();
        }
        public static function setListSousCategoriesIngredients()
        {
            include_once 'sousCategoriesIngredients.php';

            $laSousCategorieIngredient = new SousCategoriesIngredients();
            self::$listSousCategoriesIngredients = $laSousCategorieIngredient->findAll();
        }
        public static function setListTickets()
        {
            include_once 'tickets.php';

            $leTicket = new Tickets();
            self::$listTickets = $leTicket->findAll();
        }
        public static function setListTypesConditionnements()
        {
            include_once 'typesConditionnements.php';

            $leTypeConditionnement = new TypesConditionnements();
            self::$listTypesConditionnements = $leTypeConditionnement->findAll();
        }
        public static function setListUnites()
        {
            include_once 'unites.php';

            $laUnite = new Unites();
            self::$listUnites = $laUnite->findAll();
        }
    }
?>