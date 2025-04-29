# Task Manager API - Laravel 11
Une API pour gérer une liste de tâches, développée avec Laravel 11.

## Configuration requise
- PHP 8.2.28 ou supérieur
- Laravel 11.6.1
- Composer
- SQLite (avec l'extension PHP `pdo_sqlite`)
- Extension PHP GD (pour la documentation Swagger UI)

## Installation

1. Clonez le dépôt :
```bash
git clone https://github.com/Valiavo1/task-manager.git
cd task-manager
```

2. Installez les dépendances :
```bash
composer install
```

3. Configurez le fichier d'environnement :
```bash
cp .env.example .env
```

4. Générez la clé d'application :
```bash
php artisan key:generate
```

5. Préparez la base de données SQLite :
```bash
touch database/database.sqlite
```

6. Mettez à jour le fichier `.env` :
```
DB_CONNECTION=sqlite
# Supprimez ou commentez les autres lignes DB_* si besoin
```

7. Vérifiez que l'extension SQLite de PHP est activée :
```bash
# Sur Ubuntu/Debian
sudo apt install php8.2-sqlite3

# Sur macOS avec Homebrew
brew install php

# Sur Windows avec XAMPP
# L'extension est généralement déjà activée
```

8. Exécutez les migrations et le seeder :
```bash
php artisan migrate --seed
```

9. Générez la documentation Swagger :
```bash
php artisan l5-swagger:generate
```

10. Lancez le serveur de développement :
```bash
php artisan serve
```

11. Accédez à l'application :
   - Documentation API : [http://localhost:8000/api/documentation](http://localhost:8000/api/documentation)
   - Point d'entrée API : [http://localhost:8000/api/v1/tasks](http://localhost:8000/api/v1/tasks)

## Architecture du projet
- **API v1** : Points d'accès RESTful pour la gestion des tâches
- **Documentation Swagger** : Documentation interactive de l'API

## Points d'accès API

### API v1
| Méthode | URI | Description |
|---------|-----|-------------|
| GET | /api/v1/tasks | Liste toutes les tâches |
| POST | /api/v1/tasks | Crée une nouvelle tâche |
| GET | /api/v1/tasks/{id} | Affiche une tâche spécifique |
| PUT/PATCH | /api/v1/tasks/{id} | Met à jour une tâche existante |
| DELETE | /api/v1/tasks/{id} | Supprime une tâche |

## Format des requêtes

### Création d'une tâche (POST)
```json
{
  "titre": "Nom de la tâche",
  "description": "Description détaillée de la tâche (optionnel)"
}
```

### Mise à jour d'une tâche (PUT/PATCH)
```json
{
  "titre": "Nom de la tâche modifiée",
  "description": "Description modifiée (optionnel)",
  "completed": true
}
```

## Développement

### Tests
Pour exécuter les tests :
```bash
php artisan test
```

Pour exécuter uniquement les tests d'API :
```bash
php artisan test --filter=TaskApiTest
```

### Documentation Swagger
La documentation de l'API est générée avec Swagger. Pour reconstruire la documentation :
```bash
php artisan l5-swagger:generate
```

## Arrêt du serveur
Pour arrêter le serveur de développement, appuyez sur `Ctrl+C` dans le terminal où il est en cours d'exécution.
