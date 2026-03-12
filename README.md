# MSL Group `wp-content`

This repository contains the `wp-content` directory for the MSL Group WordPress site.

## What is included

- Theme files in `themes/`
- Plugin files in `plugins/`
- Must-use plugins in `mu-plugins/`
- Media uploads in `uploads/`
- Standard WordPress `wp-content` support files such as `index.php` and `db-error.php`

## What is not included

This repository does not include the full WordPress application or server-specific configuration.

- WordPress core files outside `wp-content`
- The site `wp-config.php` file
- Database credentials, salts, or other environment secrets
- Local backup, cache, and upgrade leftovers excluded by `.gitignore`

## Notes for deployment

If you already have a WordPress install on the destination server, this repository is intended to be dropped into that install as the `wp-content` directory contents.

Before deploying:

- Confirm plugin license coverage for any premium plugins included here
- Review `uploads/` for private or unnecessary files
- Keep the destination server's own `wp-config.php` and database settings in place

## Git ignore policy

This repo uses a relatively liberal `.gitignore`.

Tracked by default:

- `themes/`
- `plugins/`
- `mu-plugins/`
- `uploads/`

Ignored by default:

- `upgrade/`
- `upgrade-temp-backup/`
- Common cache and backup directories
- Local OS and log files