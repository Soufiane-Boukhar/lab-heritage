---
layout: default
chapitre: Unit test
order: 4
---

# Unit test


![Unit test](./images/unit-test.png){:width="700px" }
*Unit test*

<!-- note -->

Pour créer un fichier de test pour le modèle Membre uniquement, suivons ces étapes :

- **Créer un fichier de test :** Créez un fichier de test dans le répertoire tests/Unit de votre application Laravel. Nommez-le MembreTest.php.
- **Écrire des tests pour le modèle Membre :** Écrivez des tests pour vérifier que les opérations CRUD (Create, Read, Update, Delete) fonctionnent correctement pour le modèle Membre. Assurez-vous de tester la création d'un membre, la récupération des membres, la mise à jour des informations d'un membre et la suppression d'un membre.
- **Exécuter les tests :** Exécutez vos tests unitaires à l'aide de la commande php artisan test. Assurez-vous que tous les tests passent avec succès.

<!-- new slide -->

## Les commandes

```bash
# Pour ajouter un test
php artisan make:test MembreTest
php artisan make:test ClientTest

# Pour exécutez vos tests
php artisan test

```

<!-- new slide -->

## References

- https://laravel.com/docs/10.x/testing
- https://semaphoreci.com/community/tutorials/getting-started-with-phpunit-in-laravel

<!-- new slide -->

