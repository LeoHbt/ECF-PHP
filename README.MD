## **ECF PROJET BIBLIOTHEQUE**

### **UTILISATION**

Le site ne nécéssite pas d'être connecter pour y accéder \
Possibilitée de se connecter en utilisateur ou administrateur pour accès au CRUD

### **LIBRAIRIES UTILISES**

Pour le front :

> sweetalert2 : https://sweetalert2.github.io/

Pour le back :

> composer autoload : https://getcomposer.org/ \
> AltoRouter : https://dannyvankooten.github.io/AltoRouter//usage/install.html

### **INSTALATION DES DEPENDANCES**

Récupérez les ressources github :

> https://github.com/LeoHbt/ECF-PHP

Depuis la console

```bash
composer install
npm install
```

### **LANCEMENT DU PROJET**

### Création de la BDD

Récuperez le script sql dans le dossier ./sql puis intégrez la base de données via phpMyAdmin

L'index ne se situe pas à la racine mais dans public, donc :

```bash
php -S localhost:8000 -t public
```
