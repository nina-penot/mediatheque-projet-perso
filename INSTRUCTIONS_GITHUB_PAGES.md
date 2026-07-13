# Instructions pour Héberger la Documentation sur GitHub Pages

## Fichiers créés

✅ **Documentation HTML** : `docs/index.html`
✅ **Feuille de style** : `docs/style.css`
✅ **Documentation Markdown** : `GUIDE_ADMINISTRATEUR.md`

## Étapes pour activer GitHub Pages

### 1. Fusionner votre branche (optionnel mais recommandé)

Vous pouvez soit :
- **Option A** : Activer GitHub Pages directement sur la branche `create-documentation`
- **Option B** : Fusionner d'abord avec `main` puis activer sur `main`

Pour fusionner avec `main` :
```bash
git checkout main
git merge create-documentation
git push origin main
```

### 2. Activer GitHub Pages sur GitHub

1. Allez sur votre repository GitHub :
   `https://github.com/laplateformeio/mediatheque-tln-grp3`

2. Cliquez sur **"Settings"** (Paramètres) dans le menu du repository

3. Dans le menu latéral gauche, cliquez sur **"Pages"**

4. Dans la section **"Source"** :
   - **Branch** : Sélectionnez `create-documentation` (ou `main` si vous avez fusionné)
   - **Folder** : Sélectionnez `/docs`
   - Cliquez sur **"Save"**

5. Patientez quelques minutes (GitHub prépare votre site)

6. Actualisez la page, vous verrez un message :
   ```
   Your site is live at https://laplateformeio.github.io/mediatheque-tln-grp3/
   ```

### 3. Accéder à votre documentation

Une fois activé, votre documentation sera accessible à :

🌐 **URL :** `https://laplateformeio.github.io/mediatheque-tln-grp3/`

### 4. Partager avec vos clients

Vous pouvez maintenant partager cette URL avec vos clients. Ils pourront :
- Consulter la documentation en ligne
- Naviguer facilement grâce au menu latéral
- Imprimer la documentation si besoin
- Accéder depuis n'importe quel appareil (responsive design)

## Captures d'écran du processus

### Où trouver les paramètres Pages

```
Repository → Settings → Pages
```

### Configuration attendue

```
Source
├─ Branch: create-documentation (ou main)
├─ Folder: /docs
└─ [Save]
```

## Mise à jour de la documentation

Pour mettre à jour la documentation dans le futur :

1. Modifiez les fichiers dans le dossier `docs/` :
   - `docs/index.html` pour le contenu
   - `docs/style.css` pour le design

2. Commitez et pushez vos modifications :
   ```bash
   git add docs/
   git commit -m "Mise à jour de la documentation"
   git push
   ```

3. GitHub Pages se mettra à jour automatiquement (peut prendre 1-5 minutes)

## Vérification

Pour vérifier que tout fonctionne :

1. Visitez l'URL de votre site
2. Vérifiez que :
   - La page s'affiche correctement
   - Le style CSS est appliqué
   - La navigation fonctionne
   - Les liens internes fonctionnent

## Dépannage

### La page affiche du code brut
→ Vérifiez que vous avez bien sélectionné le dossier `/docs` et non la racine

### La page ne se charge pas
→ Attendez 5-10 minutes après activation (GitHub met du temps à déployer)

### Le CSS ne s'applique pas
→ Vérifiez que `style.css` est bien dans le dossier `docs/` à côté de `index.html`

### Erreur 404
→ Assurez-vous que la branche sélectionnée dans Settings > Pages existe et contient le dossier `docs/`

## Alternative : Téléchargement local

Si vous ne souhaitez pas utiliser GitHub Pages, vous pouvez :

1. Télécharger le dossier `docs/`
2. Ouvrir `index.html` directement dans un navigateur
3. Partager le dossier avec vos clients

## Support

Pour toute question sur GitHub Pages, consultez :
https://docs.github.com/pages
