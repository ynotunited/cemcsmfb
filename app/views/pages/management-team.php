<!-- HERO -->
<section class="page-header">
  <div class="wrap">
    <div class="page-header-inner">
      <div>
        <div class="page-header-badge reveal">
          <span class="badge-dot" style="animation: pulse 2s infinite;"></span>
          <span class="label">Leadership</span>
        </div>
        <h1 class="page-title reveal d1">Management <br/><span class="text-gradient">Team</span></h1>
      </div>
      <p class="page-desc">
        Driving our daily operations with a focus on excellence, integrity, and customer-centric financial solutions.
      </p>
    </div>
  </div>
</section>

<!-- MANAGEMENT GRID -->
<section class="section">
  <div class="wrap">
    <div class="directors-grid">

      <!-- MD -->
      <div class="director-card reveal">
        <div class="director-img-wrap">
          <img class="director-img" src="<?= APP_URL ?>/assets/images/directors/abimbola-adewale.jpg" alt="Abimbola Adewale">
          <div class="director-overlay">
            <button class="btn btn-ghost btn-sm" onclick="openBio('mgmt-adewale')">View Profile</button>
          </div>
        </div>
        <div class="director-info">
          <p class="director-role">Managing Director</p>
          <h3 class="director-name">Abimbola Adewale</h3>
        </div>
      </div>

      <!-- HEAD LEGAL/HR -->
      <div class="director-card reveal d1">
        <div class="director-img-wrap">
          <img class="director-img" src="<?= APP_URL ?>/assets/images/management/egheomwanre-osarumwense.jpg" alt="Egheomwanre Osarumwense">
          <div class="director-overlay">
            <button class="btn btn-ghost btn-sm" onclick="openBio('mgmt-osarumwense')">View Profile</button>
          </div>
        </div>
        <div class="director-info">
          <p class="director-role">Head; Legal, HR &amp; Corporate Services</p>
          <h3 class="director-name">Egheomwanre Osarumwense</h3>
        </div>
      </div>

      <!-- HEAD OPERATIONS -->
      <div class="director-card reveal d2">
        <div class="director-img-wrap">
          <img class="director-img" src="<?= APP_URL ?>/assets/images/management/ngozi-obiorah.jpg" alt="Ngozi Obiorah">
          <div class="director-overlay">
            <button class="btn btn-ghost btn-sm" onclick="openBio('mgmt-obiorah')">View Profile</button>
          </div>
        </div>
        <div class="director-info">
          <p class="director-role">Head, Operations</p>
          <h3 class="director-name">Ngozi Obiorah</h3>
        </div>
      </div>

      <!-- GROUP HEAD CREDIT & MARKETING -->
      <div class="director-card reveal">
        <div class="director-img-wrap">
          <img class="director-img" src="<?= APP_URL ?>/assets/images/management/christie-okonofua.jpg" alt="Okonofua Christie">
          <div class="director-overlay">
            <button class="btn btn-ghost btn-sm" onclick="openBio('mgmt-christie')">View Profile</button>
          </div>
        </div>
        <div class="director-info">
          <p class="director-role">Group Head, Credit &amp; Marketing</p>
          <h3 class="director-name">Okonofua Christie</h3>
        </div>
      </div>

      <!-- HEAD INTERNAL AUDIT -->
      <div class="director-card reveal d1">
        <div class="director-img-wrap">
          <img class="director-img" src="<?= APP_URL ?>/assets/images/management/ndubuisi-benedict.jpg" alt="Aniegbunem Ndubuisi Benedict O.">
          <div class="director-overlay">
            <button class="btn btn-ghost btn-sm" onclick="openBio('mgmt-benedict')">View Profile</button>
          </div>
        </div>
        <div class="director-info">
          <p class="director-role">Head, Internal Audit</p>
          <h3 class="director-name">Aniegbunem Ndubuisi Benedict O.</h3>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- MODAL -->
<div id="bio-modal" class="modal-overlay">
  <div class="modal-content">
    <button class="modal-close" onclick="closeBio()">&times;</button>
    <div id="bio-body"></div>
  </div>
</div>

<script>
const bios = {
  'mgmt-adewale': {
    name: 'Abimbola Adewale',
    role: 'Managing Director',
    photo: '<?= APP_URL ?>/assets/images/directors/abimbola-adewale.jpg',
    content: [
      "Abimbola Adewale is a seasoned banking professional with over two decades of experience spanning diverse areas, including business strategy, banking operations, foreign exchange, relationship management, product development, non-interest banking, credit risk management, retail banking, public sector marketing, microfinance, training, and SME/small business segment management. His career journey includes roles at Habib Nigeria Bank, Oceanic Bank International, Unity Bank, and UNAAB Microfinance Bank Limited.",
      "Adewale is a well-rounded strategist with expertise in business development and relationship management. He has attended numerous professional courses locally and internationally, including the Micro, SME & Housing Finance Summer Academy at the Frankfurt School of Finance and Management, Germany; Advanced Microfinance Training at the School of African Microfinance, Kenya; Deutsche Bank Training in Alternative Finance, Trade Finance, and Letters of Credit for Managers; and Leadership courses at the Lagos Business School.",
      "A Chartered Banker (ACIB) and certified microfinance practitioner from the 2012 CBN/CIBN cohort, Adewale also holds an International Certified Expert qualification in Microfinance from the Frankfurt School of Finance and Management. He was a finalist for the prestigious 2018/2019 Hubert Humphrey Fellowship and has contributed to the industry as a member of the CBN Post-Examination Monitoring Team (2013), the Microfinance Association of the UK and the National Association of Microfinance Banks.",
      "Adewale is a member of the Chartered Institute of Bankers of Nigeria (CIBN) and the Chartered Institute of Loan and Risk Management of Nigeria. He holds a Second-Class Upper Degree in Accounting, a Postgraduate Diploma in Financial Management, and an MBA from Obafemi Awolowo University, Ile-Ife.",
      "Currently, he serves as the Vice President of Aquarians Club International and Treasurer of the Onward Club of Igbogila, demonstrating his commitment to leadership and community service."
    ]
  },
  'mgmt-osarumwense': {
    name: 'Egheomwanre Osarumwense',
    role: 'Head Legal/HR/Admin & Corporate Services',
    photo: '<?= APP_URL ?>/assets/images/management/egheomwanre-osarumwense.jpg',
    content: [
      "Egheomwanre Osarumwense is a renowned and seasoned professional with a dynamic career that spans the legal and financial sectors. As a lawyer, banker, and MBA holder, she brings a wealth of knowledge and expertise in corporate governance, legal advisory, and financial management. Her multifaceted background and diverse experience make her a key asset in any organization she serves.",
      "Egheomwanre began her career working in various law firms, where she honed her legal skills across different areas of practice. Her legal expertise further expanded when she joined the government, working under the Legal Aid Council, providing critical legal services and ensuring access to justice for underrepresented communities.",
      "Transitioning into the banking industry, Egheomwanre took on roles in a Microfinance bank, where she applied her legal and financial acumen to help drive organizational growth and regulatory compliance. Her career further progressed when she moved into asset management, where she played a pivotal role in managing legal and financial risks while navigating the complexities of the asset management sector.",
      "Currently, Egheomwanre serves at CEMCS Microfinance Bank, where she continues to leverage her legal background and financial expertise to contribute to the bank's strategic initiatives and regulatory frameworks.",
      "She holds a LL.B. in Law from Ambrose Alli University, Ekpoma, a B.L from the Nigerian Law School, Abuja and an MBA from the Lagos Business School. She is also pursuing an LLM and is a member of the Nigerian Bar Association (NBA) and the Chartered Institute of Bankers of Nigeria (CIBN)."
    ]
  },
  'mgmt-obiorah': {
    name: 'Ngozi Obiorah',
    role: 'Head, Operations',
    photo: '<?= APP_URL ?>/assets/images/management/ngozi-obiorah.jpg',
    content: [
      "Ngozi is the Head of Operations of the Bank. She is in charge of monitoring and ensuring that all aspects of operations in the bank are appropriately managed across all business processes and units.",
      "Ngozi joined CEMCS MFB with over nine (9) years' work experience across various sectors of banking. She worked at United Bank for Africa Plc at different capacities and sectors including Consumer Banking, Human Resources, Domestic Operations and Foreign Operations.",
      "Ngozi joined CEMCS MFB as the pioneer Head of Operations in 2012. Three years later, she was redeployed to Business Development where she assumed the role of Head of Business Development. She also worked as Head of Credit and Appraisal before returning to Operations.",
      "Ngozi holds a B.Sc. in Banking & Finance (UNIZIK) and an MBA in Business Administration from the same university. She is a Fellow of Certified Microfinance Professional (MCP) and has attended various professional trainings, business development seminars, workshops and lectures."
    ]
  },
  'mgmt-christie': {
    name: 'Okonofua Christie',
    role: 'Group Head, Credit & Marketing',
    photo: '<?= APP_URL ?>/assets/images/management/christie-okonofua.jpg',
    content: [
      "Mrs. Christie Okonofua is the Group Head, Credit & Marketing Department of CEMCS Microfinance Bank Limited. She joined CEMCS MFB in 2012 as a Management staff and currently supervises Credit Risk and Marketing Departments as the Group Head.",
      "Christie is a highly experienced banking professional with over 22 years' experience in the Banking Industry. She started her banking career at United Bank for Africa (UBA) in 1998 and later worked in various commercial banks, including New ACB in 2001, Spring Bank in 2006, and Oceanic Bank in 2009.",
      "She came to CEMCS Microfinance Bank in 2012 as a pioneer staff, took part in all aspects of business development in new markets and generated Deposit Liability and Risk Assets for the bank.",
      "She has attended various trainings and workshops locally and internationally, including training at the Frankfurt School of Finance & Management in Germany. She holds an HND in Marketing, PGDM in Management, MBA in Business Administration and is a Certified Microfinance Banker (MCIB) and member of the Chartered Institution of Bankers of Nigeria (CIBN)."
    ]
  },
  'mgmt-benedict': {
    name: 'Aniegbunem Ndubuisi Benedict O.',
    role: 'Head of Internal Audit, Control and Compliance',
    photo: '<?= APP_URL ?>/assets/images/management/ndubuisi-benedict.jpg',
    content: [
      "Aniegbunem Ndubuisi Benedict O. is the Head of Internal Audit, Control and Compliance. He was formerly the Head of Operations. He has over nine years of experience in Microfinance with appreciable experience in the Audit and Operations Departments.",
      "He holds a Higher National Diploma (HND) in Business Administration and Management from Lagos State Polytechnic, Lagos. He is a member of the Institute of Chartered Management Auditors, Lagos (AICMA), and a certified microfinance practitioner (MCP 1, MCP 2 — CIBN Certified).",
      "Ndubuisi joined the CEMCS MFB family in 2013 as a Team Lead in the Operations Department and has since moved through the Operations and Audit Departments. He has attended various in-house trainings within the Chevron environment and external professional trainings across Lagos, Ogun State and Ibadan."
    ]
  }
};

function openBio(id) {
  const bio = bios[id];
  if (!bio) return;
  const paragraphs = bio.content.map(p => '<p>' + p + '</p>').join('');
  document.getElementById('bio-body').innerHTML =
    '<div class="modal-hero">' +
      '<img class="modal-photo" src="' + bio.photo + '" alt="' + bio.name + '">' +
      '<div class="modal-hero-info">' +
        '<p class="modal-hero-role">' + bio.role + '</p>' +
        '<h2 class="modal-hero-name">' + bio.name + '</h2>' +
      '</div>' +
    '</div>' +
    '<div class="modal-body"><div class="bio-text">' + paragraphs + '</div></div>';
  document.getElementById('bio-modal').classList.add('active');
  document.body.style.overflow = 'hidden';
}

function closeBio() {
  document.getElementById('bio-modal').classList.remove('active');
  document.body.style.overflow = '';
}

window.addEventListener('keydown', e => { if (e.key === 'Escape') closeBio(); });
document.getElementById('bio-modal').addEventListener('click', e => { if (e.target.id === 'bio-modal') closeBio(); });
</script>
