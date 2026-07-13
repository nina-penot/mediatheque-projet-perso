# 🗄️ Script de sauvegarde MySQL - Guide d'utilisation

## 📘 Description
Ce script Python permet de **sauvegarder automatiquement la base de données MySQL** utilisée par l’application.  
Chaque exécution crée un fichier `.sql` contenant l’intégralité de la base (structure + données).  
Ce mécanisme permet de restaurer facilement la base en cas de problème, de panne ou de suppression accidentelle.

---

## ⚙️ Fonctionnement

1. **Configuration**
   Les paramètres sont définis au début du script :
   ```python
   BACKUP_DIR = "/var/www/html/mediatheque-tln-grp3/utils/backup"
   DB_NAME = "php_mvc_app"
   DB_USER = "root"
   DB_PASS = "780662aB2"
   MYSQLDUMP = "/usr/bin/mysqldump"
   ```

    - `BACKUP_DIR` → dossier où seront stockées les sauvegardes
    - `DB_NAME` → nom de la base à sauvegarder
    - `DB_USER` / `DB_PASS` → identifiants MySQL
    - `MYSQLDUMP` → chemin vers la commande `mysqldump`

2. **Exécution**
   Lorsqu’il est exécuté, le script crée un fichier nommé avec la date et l’heure du backup, par exemple :
   ```
   php_mvc_app_2025-10-23_14-30-00.sql
   ```
   Ce fichier est enregistré dans le dossier indiqué par `BACKUP_DIR`.

3. **Vérification**
    - Si la sauvegarde réussit → message :
      ```
      Sauvegarde OK : /var/www/html/mediatheque-tln-grp3/utils/backup/php_mvc_app_2025-10-23_14-30-00.sql
      ```
    - Si une erreur se produit → le script affiche un message d’erreur et supprime le fichier incomplet.

---

## 🧩 Détails techniques
- **Langage** : Python
- **Outil utilisé** : `mysqldump` (utilitaire MySQL)
- **Résultat** : fichier `.sql` de sauvegarde
- **Emplacement des sauvegardes** : `/var/www/html/mediatheque-tln-grp3/utils/backup`

---

## 🕒 Automatisation (recommandée)
Pour automatiser la sauvegarde, vous pouvez planifier le script avec **cron** (sous Linux).  
Exemple pour exécuter la sauvegarde tous les jours à 2h du matin :
```bash
0 2 * * * /usr/bin/python3 /chemin/vers/backup_script.py
```

---

## 🔐 Sécurité
- Évitez de laisser le mot de passe en clair dans le script.
- Vous pouvez utiliser des **variables d’environnement** ou un fichier `.my.cnf` sécurisé.
- Assurez-vous que le dossier de sauvegarde n’est pas accessible publiquement via le web.

---

## 🔁 Restauration d'une sauvegarde
Pour restaurer une base de données à partir d’un fichier `.sql`, utilisez la commande suivante :
```bash
mysql -u root -p php_mvc_app < /chemin/vers/le_fichier_de_sauvegarde.sql
```

---

© 2025 – Utilitaire de sauvegarde de base de données pour le projet Médiathèque (Groupe 3)