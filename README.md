Create two web sites for testing. One is named alice, the other is bob. For EACH of those, follow these steps:

1. Git clone this repo to your laptop.
1. From the root of the repo, ...
1. mysql -uroot DB_NAME < dump.sql #replace DB_NAME with 'alice' or 'bob'
1. Copy settings.local.php to sites/default and point to your new DB (see bottom of file).
1. Create your config dirs under files/ as specified in settings.local.php. Copy config_vcs/* into active config dir.
1. Optional: point a website at the docroot dir.

You may now use drush config-edit command to make changes and config-import + config-export to sling changes to/from your config_vcs dir.
