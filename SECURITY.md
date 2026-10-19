# Security Policy

**⚠️ IMPORTANT NOTE:**

This project follows **best-practice security**, but **cannot guarantee 100% protection** against zero-day exploits or highly targeted attacks.
For **enterprise-grade security requirements**, use **commercially supported solutions** with dedicated threat intelligence.

---

## Threat model

**Considered attack vectors** (prioritized by likelihood/risk):

1. **Supply chain**
2. **Dependency updating**
3. **Business logic bypass**

---

## Supply chain security

Every release is built via GitHub Actions with CI runner hardening enabled.
Each release artifact ships with a **SLSA Build Level 3** provenance file
and a **SHA-256 checksum** — both are published on the release page and can
be used to verify the integrity of the ZIP archive.

### Dependency locking

- GitHub Actions
  - **Status:** **SHA-pinned via lockfile**
  - **Details:** Workflow files reference actions by version tag (required for Renovate's `minimumReleaseAge` cooldown), but the commit actually executed on the runner is pinned via `.github/workflows/actions.lock`, maintained automatically by Renovate (`gh-actions-lock`).

---

## CI hardening

### Protections

- **StepSecurity Harden Runner** is enabled for all GitHub Actions workflows (except reusable workflows run in other repositories). It monitors outbound network and process activity on the runner at runtime and provides telemetry for suspicious behavior.
- **Socket “sfw” firewall wrapper** is used around some high-risk tooling (e.g., package managers) to add an additional inspection layer for supply‑chain risks.
- **StepSecurity hardened/drop-in Actions** (for example, replacements for popular third‑party Actions) are preferred where available, so that entire Actions are vetted and maintained by a security-focused vendor. However, these hardened variants may sometimes lag behind upstream releases, so regular upstream Actions are still used when the StepSecurity replacement is not yet updated.

### Network egress policy

Ideally, this project aims to enforce a strict egress policy using Harden Runner:

- High‑risk jobs (write permissions, secrets, CD/publishing) should use `egress-policy: block` with an explicit `allowed-endpoints` allowlist to limit data exfiltration if an Action or dependency is compromised.
- Low‑risk jobs (read‑only, no secrets) should use `egress-policy: audit`, because scanning and analysis tools may legitimately contact changing endpoints over time and hard blocking would add too much maintenance overhead.

In practice, not all jobs currently run in `block` mode: most jobs use `egress-policy: audit` today, and block mode may be enabled selectively for the most sensitive workflows as maintenance capacity allows.

---

## Security scanning

Security scans (SCA/SAST/IAST) covering the codebase, its dependencies, and the CI/GitHub Actions pipeline are run regularly: SCA/SAST checks are triggered automatically on every commit and on a daily schedule, while deeper IAST scans (using AI agents) are launched manually during major refactors or upon request.

---

## Dependency updating

Dependencies are kept up to date using [Renovate](https://github.com/renovatebot/renovate).

- **Regular (non-security) updates:**
  - Checked at least **weekly**.
  - A `minimumReleaseAge` of **3 days** is applied, so only versions that have been out for a while are adopted for normal updates.

- **Security-related updates:**
  - Processed **without artificial delay** — security patches are not held back by `minimumReleaseAge`.
  - Renovate security advisories and/or GitHub’s security alerts are handled as soon as possible once available.

---

## Repository hardening

GitHub repository-level settings:

- **Force-push protection:** **Enabled**.
- **Secret Protection (push protection + secret scanning):** **Enabled**.
- **Dependabot security alerts:** **Not enabled**.
- **Immutable releases:** **Not enabled**.
- **Branch protection rules:** **Not enabled**.
- **Required signed commits/Required signed tags:** **Not enabled**.
- **Mandatory PR review:** **Not enabled**.

---

## Reporting a vulnerability

If you discover a security vulnerability, please use the
[Security tab](https://github.com/alex2276564/FOSSManualPayment/security/advisories) to report it privately.  
Do **not** disclose security vulnerabilities publicly before they have been addressed.
