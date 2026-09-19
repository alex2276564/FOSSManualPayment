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

---

## CI hardening

All CI jobs are protected by StepSecurity Harden Runner, which monitors
outbound network and process activity on the runner at runtime.

Third-party Actions are referenced by tag rather than commit SHA.
SHA pinning is intentionally not used — it only provides strong guarantees
when combined with manual review of every upstream commit, which this
single-developer project cannot sustain. Runtime monitoring via Harden Runner
is the primary supply-chain control instead.

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

## Reporting a vulnerability

If you discover a security vulnerability, please use the
[Security tab](https://github.com/alex2276564/FOSSManualPayment/security/advisories) to report it privately.  
Do **not** disclose security vulnerabilities publicly before they have been addressed.
