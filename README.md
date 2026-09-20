# Alvario — Backend API

Backend d'une plateforme e-commerce développée avec **Laravel** et **MySQL**.

L'objectif du projet est de fournir une API REST permettant de gérer les produits, catégories, variantes, utilisateurs et commandes d'une boutique en ligne.

---

## 🚀 Technologies utilisées

* **Laravel 12**
* **PHP 8.2+**
* **MySQL / MariaDB**
* **Laravel Sanctum**
* **REST API**
* **Postman**
* **Git & GitHub**

---

## 📌 Fonctionnalités

### Gestion des catégories

* Créer une catégorie
* Afficher toutes les catégories
* Afficher une catégorie
* Modifier une catégorie
* Supprimer une catégorie

### Gestion des produits

* Créer un produit
* Afficher les produits
* Afficher un produit
* Modifier un produit
* Supprimer un produit
* Gestion du stock
* Gestion du prix et de l'ancien prix
* Association avec une catégorie

### Gestion des images

* Ajouter une image à un produit
* Afficher les images d'un produit
* Modifier une image
* Supprimer une image

### Gestion des variantes

* Ajouter une variante à un produit
* Gérer la taille
* Gérer la couleur
* Gérer le stock des variantes

### Gestion des utilisateurs

* Inscription
* Connexion
* Déconnexion
* Gestion des rôles : `client` / `admin`

### Gestion des commandes

* Créer une commande
* Consulter les commandes
* Gérer les informations du client
* Gérer le total de la commande
* Gérer le statut
* Mode de paiement : paiement à la livraison

---

## 🗄️ Structure principale de la base de données

Le projet utilise plusieurs tables principales :

* `utilisateurs`
* `categories`
* `produits`
* `images_produit`
* `variantes_produit`
* `commandes`
* `articles_commande`

### Relations principales

```text
Categorie
   │
   └── Produit
          │
          ├── ImageProduit
          │
          └── VarianteProduit

Utilisateur
   │
   └── Commande
          │
          └── ArticleCommande
                  │
                  └── Produit
```

---

## ⚙️ Installation

### 1. Cloner le projet

```bash
git clone https://github.com/mohamedamine-dev-fullstack/alvario-api-backend.git
```

Puis :

```bash
cd alvario-api-backend
```

### 2. Installer les dépendances

```bash
composer install
```

### 3. Créer le fichier `.env`

```bash
cp .env.example .env
```

Sous Windows, vous pouvez également copier `.env.example` manuellement et le renommer en `.env`.

### 4. Générer la clé Laravel

```bash
php artisan key:generate
```

### 5. Configurer la base de données

Dans le fichier `.env` :

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=alvario
DB_USERNAME=root
DB_PASSWORD=
```

Adaptez les informations selon votre configuration MySQL.

### 6. Exécuter les migrations

```bash
php artisan migrate
```

### 7. Insérer les données de test

```bash
php artisan db:seed
```

### 8. Lancer le serveur

```bash
php artisan serve
```

L'API sera disponible sur :

```text
http://127.0.0.1:8000
```

---

## 🔐 Authentification

L'API utilise **Laravel Sanctum** pour l'authentification.

### Connexion

```http
POST /api/login
```

### Déconnexion

```http
POST /api/logout
```

Les routes protégées nécessitent un token d'authentification.

---

## 🔗 Principales routes API

### Categories

```http
GET     /api/categories
POST    /api/categories
GET     /api/categories/{id}
PUT     /api/categories/{id}
DELETE  /api/categories/{id}
```

### Produits

```http
GET     /api/produits
POST    /api/produits
GET     /api/produits/{id}
PUT     /api/produits/{id}
DELETE  /api/produits/{id}
```

### Images produit

```http
GET     /api/images-produit
POST    /api/images-produit
GET     /api/images-produit/{id}
PUT     /api/images-produit/{id}
DELETE  /api/images-produit/{id}
```

### Variantes produit

```http
GET     /api/variantes-produit
POST    /api/variantes-produit
GET     /api/variantes-produit/{id}
PUT     /api/variantes-produit/{id}
DELETE  /api/variantes-produit/{id}
```

---

## 🧪 Tests avec Postman

Les endpoints peuvent être testés avec **Postman**.

Exemple :

```http
GET http://127.0.0.1:8000/api/categories
```

Réponse :

```json
[
    {
        "id": 1,
        "nom": "Soins & Hygiène Homme",
        "slug": "soins-hygiene-homme"
    }
]
```

---

## 📂 Structure du projet

```text
alvario-api-backend/
│
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │
│   └── Models/
│
├── database/
│   ├── migrations/
│   └── seeders/
│
├── routes/
│   └── api.php
│
├── config/
├── public/
├── resources/
├── storage/
├── .env.example
├── composer.json
└── README.md
```

---

## 📦 Catégories actuelles

Le projet contient actuellement trois catégories :

1. **Soins & Hygiène Homme**
2. **Casquettes & Chapeaux**
3. **Sous-vêtements Homme**

---

## 🎯 Objectif du projet

Ce projet a été réalisé dans le but de mettre en pratique le développement d'une **API REST e-commerce** avec Laravel.

Il permet également de travailler sur :

* la conception d'une base de données relationnelle ;
* les relations entre modèles Laravel ;
* les opérations CRUD ;
* l'authentification avec Sanctum ;
* la gestion des commandes ;
* les tests d'API avec Postman ;
* la préparation d'un backend destiné à être connecté à un frontend.

---

## 👨‍💻 Auteur

**Mohamed Amine Laktaoui**

Développeur Web Full Stack Junior

* GitHub : `mohamedamine-dev-fullstack`

---

## 📄 Licence

Ce projet est un projet personnel réalisé à des fins d'apprentissage et de développement de compétences.
