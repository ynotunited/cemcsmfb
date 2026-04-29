# Byet Host Auto-Deploy (GitHub Actions)

This project is configured to deploy automatically to Byet Host whenever code is pushed to `main` or `master`.

## 0) Byet Host Details

- `Cpanel URL`: `http://cpanel.byethost3.com/`
- `Site URL`: `http://cemcfb.byethost3.com` or `http://www.cemcfb.byethost3.com`
- `FTP Server`: `ftpupload.net`
- `FTP Username`: `b3_41782053`
- `MySQL Host`: `sql113.byethost3.com`
- `MySQL Database`: `b3_41782053_cemcsmfb`

For the quickest setup, the GitHub Actions workflow currently uses the Byet FTP account details directly so deployment can run without extra manual secret setup. If you want to harden it later, move the password back into a GitHub secret.

## 1) Add GitHub Secrets

In your GitHub repo:

- `Settings` -> `Secrets and variables` -> `Actions` -> `New repository secret`

Create these secrets only if you later want to move credentials out of the workflow:

- `BYET_FTP_SERVER`: your FTP host from Byet VistaPanel
- `BYET_FTP_USERNAME`: your FTP username
- `BYET_FTP_PASSWORD`: your FTP password
- `BYET_SERVER_DIR`: your remote web root (usually `htdocs/`)
- `DB_HOST`: `sql113.byethost3.com`
- `DB_USER`: `b3_41782053`
- `DB_NAME`: `b3_41782053_cemcsmfb`
- `DB_PASS`: your Byet database password

## 2) Workflow File

The workflow is located at:

- `.github/workflows/deploy-byet-host.yml`

It runs on:

- Push to `main`
- Push to `master`
- Manual trigger from the Actions tab (`workflow_dispatch`)

## 3) First Deployment Check

1. Push a small change to GitHub.
2. Open `GitHub -> Actions -> Deploy To Byet Host`.
3. Confirm the run succeeds.
4. Refresh your Byet-hosted website.

## 4) Notes

- Deployment uses FTPS.
- `docs/`, `.github/`, `.env*`, and Git metadata are excluded from upload.
- The app automatically falls back to the Byet database settings on hosted environments, while keeping local development on `localhost`.
