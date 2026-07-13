#!/bin/bash
echo "============================================"
echo "Synchronisation BDD vers Raspberry Pi"
echo "============================================"

# Configuration
DB_USER="root"
DB_PASS="780662aB2"
DB_NAME="php_mvc_app"

RASPBERRY_IP="192.168.10.146"
RASPBERRY_USER="darksh3ll"
RASPBERRY_SSH_PASS="780662aB2"  # ← AJOUTEZ le mot de passe SSH ici
RASPBERRY_MYSQL_USER="root"
RASPBERRY_MYSQL_PASS="780662aB2"

BACKUP_FILE="/tmp/dump_temp.sql"

# 1. Créer le dump
echo ""
echo "[1/3] Création du dump de la base de données..."
mysqldump -u $DB_USER -p$DB_PASS $DB_NAME > $BACKUP_FILE

if [ $? -ne 0 ]; then
    echo "❌ ERREUR lors de la création du dump!"
    exit 1
fi
echo "✓ Dump créé avec succès!"

# 2. Transférer vers le Raspberry (AVEC sshpass)
echo ""
echo "[2/3] Transfert vers le Raspberry..."
sshpass -p "$RASPBERRY_SSH_PASS" scp -o StrictHostKeyChecking=no $BACKUP_FILE $RASPBERRY_USER@$RASPBERRY_IP:/tmp/dump.sql

if [ $? -ne 0 ]; then
    echo "❌ ERREUR lors du transfert!"
    rm $BACKUP_FILE
    exit 1
fi
echo "✓ Transfert terminé!"

# 3. Importer sur le Raspberry (AVEC sshpass)
echo ""
echo "[3/3] Import sur le Raspberry..."
sshpass -p "$RASPBERRY_SSH_PASS" ssh -o StrictHostKeyChecking=no $RASPBERRY_USER@$RASPBERRY_IP "mysql -u $RASPBERRY_MYSQL_USER -p$RASPBERRY_MYSQL_PASS $DB_NAME < /tmp/dump.sql && rm /tmp/dump.sql"

if [ $? -ne 0 ]; then
    echo "❌ ERREUR lors de l'import!"
    rm $BACKUP_FILE
    exit 1
fi
echo "✓ Import réussi!"

# 4. Nettoyer
rm $BACKUP_FILE

echo ""
echo "============================================"
echo "✓ Synchronisation terminée avec succès!"
echo "============================================"