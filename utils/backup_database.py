
import os
from datetime import datetime

# --- ADAPTE ICI ---
BACKUP_DIR = "/var/www/html/mediatheque-tln-grp3/utils/backup"
DB_NAME = "php_mvc_app"
DB_USER = "root"
DB_PASS = "780662aB2"
MYSQLDUMP = "/usr/bin/mysqldump"  # ou just "mysqldump" si dans le PATH
# --------------------

os.makedirs(BACKUP_DIR, exist_ok=True)
ts = datetime.now().strftime("%Y-%m-%d_%H-%M-%S")
outfile = os.path.join(BACKUP_DIR, f"{DB_NAME}_{ts}.sql")

# commande simple — note: le mot de passe est passé en clair (-pPASSWORD)
cmd = f'{MYSQLDUMP} -u{DB_USER} -p{DB_PASS} {DB_NAME} > "{outfile}"'

ret = os.system(cmd)
if ret == 0:
    print("Sauvegarde OK :", outfile)
else:
    print("Erreur lors du mysqldump (code retour", ret, ")")
    # suppression possible d'un fichier vide/incomplet
    try:
        os.remove(outfile)
    except OSError:
        pass
    exit(1)

