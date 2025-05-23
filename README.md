# 🔶Introduction au projet
**Overhub** est une plateforme web communautaire dédiée à l'univers d'Overwatch, conçue pour rassembler les passionnés du jeu en un lieu de" présentation des héros et de leur abilités et aussi un centre d'échange et d'information.

Overhub a été créé avec l'ambition de devenir un carrefour pour les joueurs d'Overwatch qui souhaitent :

- Explorer en profondeur les profils et capacités des héros.
- Rester informés des dernières mises à jour et événements.
- Partager leurs expériences et stratégies avec d'autres passionnés.
- Construire une communauté active et bienveillante autour du jeu.

Cette plateforme offre à la fois une base de données sur les personnages de l'univers d'Overwatch et un espace social interactif pour échanger avec d'autres passionnés du jeu.

## 🎮 Overwatch en résumé
Overwatch est un jeu de tir à la première personne en équipe développé par Blizzard Entertainment. Lancé en 2016, il se déroule dans un futur optimiste où des héros aux capacités uniques s'affrontent dans diverses missions à travers le monde.

## 🛠️ Méthodologie de travail
Voici les étapes que j’ai suivies pour mener à bien ce projet d’application autour du jeu Overwatch :

### 1. 📦 Documentation
- Rédaction du **README** avec explications claires de mes idées à l'origine du projet. Ce fichier sera mise à jour au fil du développement du projet.

### 2. 💻 Choix des technologies et sources web qui seront utilisées

1. **Frontend**: 
- [Tailwind CSS (v3.1.4)](https://v3.tailwindcss.com/): Principalement choisie car c'est une framework que j'utilise beaucoup dans mes projets. Il permet de styliser rapidement une interface via des classes pré-définies. Il facilite le développement responsive et l’uniformité du design tout en évitant la surcharge de fichiers CSS. 
-  [Uiverse](https://uiverse.io/): C'est une bibliothèque communautaire de composants UI animés et personnalisables (boutons, cartes, loaders, etc.), que l’on peut copier/coller facilement avec Tailwind CSS. Cela m’a permis de gagner du temps tout en apportant un style moderne à l’interface et c'est aussi un site que j'utilise beaucoup dans mes projets. Je l'apprécie pour sa simplicité et son efficacité. 
2. **Backend**: 
- [Symfony (v6.14)](https://symfony.com/): Framework PHP robuste et flexible utilisé pour construire l’API backend du projet. Il facilite la gestion des routes, des bases de données, de la sécurité et des formulaires, tout en respectant l’architecture MVC.
3. **Base de données**: 
- [MySQL](https://www.mysql.com/fr/): Système de gestion de base de données relationnelle très répandu. Je l'ai utilisé ici pour stocker les données des héros, des rôles et autres informations de l’application.
- [PhpMyAdmin (v9.1)](https://www.phpmyadmin.net/): Interface web graphique permettant de gérer facilement les bases de données MySQL : création de tables, insertion de données, exécution de requêtes SQL, etc.
4.  **Encyclopédie des héros**: 
- [Overwatch.Fandom](https://overwatch.fandom.com/wiki/Overwatch_Wiki): Wiki communautaire très complet utilisé comme base pour collecter des informations sur les héros, leurs capacités, leurs rôles et les dernières mises à jour du jeu.
- [Overwatch.Blizzard](https://overwatch.blizzard.com/fr-fr/): Site officiel du jeu, utilisé pour vérifier l’exactitude des données, récupérer des visuels officiels et obtenir des descriptions à jour directement de la source.

### 3. 🌟Listes des fonctionnalités principales
1. **Encyclopédie des héros**
- Base de données complète de tous les personnages d'Overwatch.
- Fiches détaillées incluant biographies, capacités...
2. **Profils personnalisés**
- Création de comptes.
- Suivi des héros et sujets favoris.
- Système de notifications pour les mises à jour.
3. **Contact et Aide**
- Newsletter disponible pour être notifié de nouvelles fonctionnalités.
- Formulaire de contact pour les utilisateurs ayant besoin d'aide.

## 4.🎨 Interface utilisateur
1. Travail sur le design et l’ergonomie pour offrir une bonne expérience à l’utilisateur.
- **Couleur du site**: 
- **Cartes Héros**: 
- **Formulaire de contact**:
- **Formulaire de login**: 
2. Adaptation responsive pour une utilisation sur différents appareils avec TailwindCss.

## 5.⚡Problèmes et solutions trouvés
| Problème  | Solution  | Notes |
| :------------ |:---------------:| -----:|
| **@Hotwired/stimulus Not Found** |Supprimer `bootstrap.js` et le dossier `controllers` aussi. Supprimer aussi les dépendances qui correspondent dans le fichier `importmap.php`. Ensuite taper la commande : `composer remove symfony/stimulus-bundle symfony/ux-turbo` pour bien retirer les dépendances. |Je n'ai pas encore rencontré ce problème sur le moment mais il apparaît toujours plus tard dans mes applications. Je ne veux pas qu'il intérrompe mon rythme de travail donc je préfère m'en débarasser avant qu'il n'arrive.|
| **Messengers_message**    | Supprimer le fichier dans le `package/messenger.yaml` puis faire ma migration afin qu'elle soit prise en compte.     |    Comme recommendé je l'ai supprimé directement pour éviter tout conflit futur.       |
|   **Non-concordance entre les noms déclarés dans les fichiers**   |  Adapter les variables de l'entité `Role.php` dans `Character.php` | J'ai eu du mal avant de voir d'où provenait l'erreur mais finalement je l'ai reglé. La prochaine fois je prendrais des notes plus précise quant au nom de mes entités et propriétés et je respecterais le nommage recommendé pour m'éviter d'autres problèmes.  |
| **Migrations qui entrent en conflit** |Supprimer les migrations passées et en faire une nouvelle tout en vérifiant le fichier avant de le valider | Le fait d'avoir plusieurs version de migration ainsi que le fait que j'avais changé la clé étrangère dans la table `character` m'a causé quelques problèmes. Je veillerais à faire le ménage dans mes fichiers pour être plus tranquille. | 
| **Erreur de chargement de données dans un tableau**  |  Transformer le tableau en string. J'utilise la variable `$data['name']` dans la boucle `foreach` | J'avais oublié qu'il fallait convertir mon tableau donc j'avais eu cette erreur mais après un peu de recherche j'ai eu la solution. Je n'ai pas perdu trop de temps dessus.  |

## 6. 🔮 Fonctionnalités à venir
| Fonctionnalité | Notes |
| :------------ | -----:|
| **AddFlash qui disparaître après un certains temps** | Je ne pense pas pouvoir faire ça avec seulement TailwindCSS. Je crois qu'avec du JavaScript cela sera plus facile à faire. Donc je continuerais à développer ette fonctionnalité après avoir appris ce language en profondeur.|
| **Commentaire en dessous des personnages** | Vu que je dois rendre le projet bientôt je ne penses pas que j'aurais le temps de le faire. Je le rajouterais plus tard.|
## Fin
