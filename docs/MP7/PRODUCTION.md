## Actualització producció

```
ssh server
cd domini
npm install
composer install
Base de dades?
php artisan migrate:fresh --seed
Laravel passport
php artisan passport:keys
```

## Branca production

Vau crear la branca amb:

```
git checkout -b NOM_BRANCA
```

Canvi de branques:

```
git checkout NOM_BRANCA
```

Per exemple, canviar a production:

```
git checkout production
```

Per exemple, tornar a master:

```
git checkout master
```

## Actualitzar producció

**NOTA/IMPORTANT**: Aturar npm run hot

El procediment és:

```
Aturar npm run hot
git checkout master
co
git checkout production
git status -> Nets?
git merge master
git status -> net
git commit -a "WIP"
git checkout master
git push --all origin 
```

### Troubleshooting. Resolució de problemes

Conflicte si git merge avisa de conflicte:

Opció 1:
```
git status -> I llegir:
git checkout -- public/mix-manifest.json // Abans aturar npm run hot
git status -> net
git merge
```

Opció 2:
Resoldre el conflicte:
- PHPSTORM: Menú contextual sobre el fitxer en conflicte -> Git -> Resolve conflicts

Un cop resolt no us oblideu continuar amb les comandes: 

```
git status -> net
git commit -a "WIP"
git checkout master
git push --all origin 
```
