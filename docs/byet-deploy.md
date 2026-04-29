# Byet Host Auto-Deploy (GitHub Actions)

This project is configured to deploy automatically to Byet Host whenever code is pushed to `main` or `master`.

## 1) Add GitHub Secrets

In your GitHub repo:

- `Settings` -> `Secrets and variables` -> `Actions` -> `New repository secret`

Create these secrets:

- `BYET_FTP_SERVER`: your FTP host from Byet VistaPanel
- `BYET_FTP_USERNAME`: your FTP username
- `BYET_FTP_PASSWORD`: your FTP password
- `BYET_SERVER_DIR`: your remote web root (usually `htdocs/`)

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
