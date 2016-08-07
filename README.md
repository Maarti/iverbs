# Irregular verbs
Website for training in the conjugation of English irregular verbs


## Installation

The website is already deployed [here](http://iverbs.maarti.net), ready to be used.

If you want to install it yourself, don't forget to create the file `include/sql-inc.php` where you connect the site to your own database :
```
<?php
$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
$bdd = new PDO('mysql:host={HOST};dbname={DATABASE_NAME}', '{USER}', '{PASSWORD}', $pdo_options);
?>
```
Where :
- `{HOST}` is your database host name (ex : localhost)
- `{DATABASE_NAME}` is your database name
- `{USER}` is the login of your database account
- `{PASSWORD}` is the password of your database account

## Usage

Click "Test!" then "Test traditionnel". Fill in the fields then click "Rendre la copie".

## Contributing

1. Fork it!
2. Create your feature branch: `git checkout -b my-new-feature`
3. Commit your changes: `git commit -am 'Add some feature'`
4. Push to the branch: `git push origin my-new-feature`
5. Submit a pull request :D

## History

Site created during my second year of Vocational Training Certificate (2011) to allow my class to practice for the weekly test of irregular verbs. Developed alone.

## Credits

[Maarti](http://maarti.net)

## License

MIT License
