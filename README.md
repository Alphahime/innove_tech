# innove_tech



Bienvenue dans l'application Innove Solution ! Cette application vous permet de gérer des idées  et de collaborer avec d'autres utilisateurs pour développer de nouvelles solutions.

# Structure des Fichiers

# L'application est structurée comme suit :

   -  index.php : Page d'accueil de l'application. Affiche une brève introduction et des liens vers d'autres pages.
   - ideas.php : Page principale pour afficher toutes les idées enregistrées dans la bade données. Permet également de créer de nouvelles idées et de les modifier.
   - login.php : Page de connexion pour les utilisateurs enregistrés. Les utilisateurs doivent se connecter pour accéder à certaines fonctionnalités de l'application.
    -register.php : Page d'inscription pour les nouveaux utilisateurs. Les nouveaux utilisateurs doivent s'inscrire pour créer un compte et accéder à l'application.
   - edit.php : Page de modification des idées. Permet aux utilisateurs de modifier les détails d'une idée existante.
   - logout.php : Page de déconnexion pour les utilisateurs connectés. Permet aux utilisateurs de se déconnecter de leur session.
   - delete_idea.php  : Page pour supprimer une idée donnée ;
   - idea.php : Pour afficher les details des idées notemment sa date de création l'identifiants du categorie et les idées .
   - profile.php : Pour modifier son profil d'utilisateur( pas encore aboutit)

# Guide d'Utilisation

    Inscription et Connexion :
        Pour accéder à toutes les fonctionnalités de l'application, les utilisateurs doivent d'abord s'inscrire en utilisant la page register.php.
        Une fois inscrit, les utilisateurs peuvent se connecter en utilisant la page login.php.

  #  Affichage des Idées :
        Une fois connecté, les utilisateurs sont redirigés vers la page ideas.php où ils peuvent voir toutes les idées enregistrées dans la base de données.
        Les utilisateurs peuvent également créer de nouvelles idées en utilisant le formulaire sur cette page.

   # Modification des Idées :
        Pour modifier une idée existante, les utilisateurs peuvent cliquer sur le lien de modification sur la page ideas.php. Cela les dirigera vers la page edit.php où ils peuvent mettre à jour les détails de l'idée.

   # Déconnexion :
        Les utilisateurs peuvent se déconnecter de leur session à tout moment en utilisant la page logout.php.

# Configuration Requise

# Avant d'utiliser l'application, essayer de configurr  votre  l'environnement développement avec ces outils:

    Serveur Web (comme Apache )
    Serveur de Base de Données ( MySQL)
    PHP (version recommandée : PHP version 7,8)
    PDO activé pour PHP pour la connexion de la base de données

# Configuration de la Base de Données

L'application utilise une base de données MySQL pour stocker les informations des utilisateurs et des idées. Configurer  les informations de connexion à la base de données dans les fichiers PHP (ideas.php, edit.php, login.php, register.php, logout.php).
Auteur

"Developpée par Alpha Ndiaye".