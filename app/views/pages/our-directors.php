<!-- HERO -->
<section class="page-header">
  <div class="wrap">
    <div class="page-header-inner">
      <div>
        <div class="page-header-badge reveal">
          <span class="badge-dot" style="animation: pulse 2s infinite;"></span>
          <span class="label">Governance</span>
        </div>
        <h1 class="page-title reveal d1">The Bank <br /><span class="text-gradient">Directors</span></h1>
      </div>
      <p class="page-desc">
        Guided by a board of seasoned professionals with decades of experience in global finance, energy, and
        technology.
      </p>
    </div>
  </div>
</section>

<!-- DIRECTORS GRID -->
<section class="section">
  <div class="wrap">
    <div class="directors-grid">

      <!-- CHAIRPERSON -->
      <div class="director-card reveal">
        <div class="director-img-wrap">
          <img class="director-img" src="<?= APP_URL ?>/assets/images/directors/oyenike-oyedele.jpg"
            alt="Ms. Oyenike Oyedele">
          <div class="director-overlay">
            <button class="btn btn-ghost btn-sm" onclick="openBio('bio-nike')">View Profile</button>
          </div>
        </div>
        <div class="director-info">
          <p class="director-role">Chairperson</p>
          <h3 class="director-name">Ms. Oyenike Oyedele</h3>
        </div>
      </div>

      <!-- DIRECTOR - TOSIN AMOO -->
      <div class="director-card reveal d1">
        <div class="director-img-wrap">
          <img class="director-img" src="<?= APP_URL ?>/assets/images/directors/tosin-amoo.jpg" alt="Mr. Tosin Amoo">
          <div class="director-overlay">
            <button class="btn btn-ghost btn-sm" onclick="openBio('bio-amoo')">View Profile</button>
          </div>
        </div>
        <div class="director-info">
          <p class="director-role">Director</p>
          <h3 class="director-name">Mr. Tosin Amoo</h3>
        </div>
      </div>

      <!-- DIRECTOR - ESANUBI -->
      <div class="director-card reveal">
        <div class="director-img-wrap">
          <img class="director-img" src="<?= APP_URL ?>/assets/images/directors/frank-esanubi.jpg"
            alt="Mr. Frank Esanubi">
          <div class="director-overlay">
            <button class="btn btn-ghost btn-sm" onclick="openBio('bio-esanubi')">View Profile</button>
          </div>
        </div>
        <div class="director-info">
          <p class="director-role">Director</p>
          <h3 class="director-name">Mr. Frank Esanubi</h3>
        </div>
      </div>

      <!-- DIRECTOR - OLAYISADE -->
      <div class="director-card reveal d1">
        <div class="director-img-wrap">
          <img class="director-img" src="<?= APP_URL ?>/assets/images/directors/olayisade-adegboyega.jpg"
            alt="Mr. Olayisade Adegboyega">
          <div class="director-overlay">
            <button class="btn btn-ghost btn-sm" onclick="openBio('bio-olayisade')">View Profile</button>
          </div>
        </div>
        <div class="director-info">
          <p class="director-role">Director</p>
          <h3 class="director-name">Mr. Olayisade Adegboyega</h3>
        </div>
      </div>

      <!-- DIRECTOR - ONI -->
      <div class="director-card reveal">
        <div class="director-img-wrap">
          <img class="director-img" src="<?= APP_URL ?>/assets/images/directors/seun-oni.jpg" alt="Ms. Seun Oni">
          <div class="director-overlay">
            <button class="btn btn-ghost btn-sm" onclick="openBio('bio-oni')">View Profile</button>
          </div>
        </div>
        <div class="director-info">
          <p class="director-role">Director</p>
          <h3 class="director-name">Ms. Seun Oni (INED)</h3>
        </div>
      </div>

      <!-- DIRECTOR - PRINCEWILL -->
      <div class="director-card reveal d1">
        <div class="director-img-wrap">
          <img class="director-img" src="<?= APP_URL ?>/assets/images/directors/princewill-hope.jpg"
            alt="Mr. Princewill Hope">
          <div class="director-overlay">
            <button class="btn btn-ghost btn-sm" onclick="openBio('bio-princewill')">View Profile</button>
          </div>
        </div>
        <div class="director-info">
          <p class="director-role">Director</p>
          <h3 class="director-name">Mr. Princewill Hope</h3>
        </div>
      </div>

      <!-- MD - LAST -->
      <div class="director-card reveal">
        <div class="director-img-wrap">
          <img class="director-img" src="<?= APP_URL ?>/assets/images/directors/abimbola-adewale.jpg"
            alt="Abimbola Adewale">
          <div class="director-overlay">
            <button class="btn btn-ghost btn-sm" onclick="openBio('bio-adewale')">View Profile</button>
          </div>
        </div>
        <div class="director-info">
          <p class="director-role">Managing Director</p>
          <h3 class="director-name">Abimbola Adewale</h3>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- MODALS (BIO OVERLAYS) -->
<div id="bio-modal" class="modal-overlay">
  <div class="modal-content">
    <button class="modal-close" onclick="closeBio()">&times;</button>
    <div id="bio-body"></div>
  </div>
</div>

<script>
const bios = {
  'bio-nike': {
    name: 'Ms. Oyenike Oyedele',
    role: 'Chairperson',
    photo: '<?= APP_URL ?>/assets/images/directors/oyenike-oyedele.jpg',
    content: [
      "Oyenike has had an interesting career working across three globally reputable organizations. With short stints in manufacturing at Procter and Gamble and in banking at First Bank of Nigeria Ltd, before commencing her current 17-year career in Chevron Nigeria, the breadth and depth of her professional experience is rare amongst her peers.",
      "In her Oil and Gas journey, she has occupied a plethora of roles including leading all Chevron Nigeria's production optimization and energy optimization initiatives; delivering several successful behemoth projects — many of which have been NMA SBU's leading scorecard investments including Chevron Nigeria's largest Major Capital Project within the 2015–2020 execution era; leading engagements with various government parastatals including NNPC (NUIMS), NUPRC and NCDMB; developing Business Unit Annual Financial Plans and Business Continuity Plans; and championing audits as part of the company's Operational Excellence Management Process.",
      "In testament of her influence and credibility within Chevron Nigeria Mid-Africa Business Unit, aside from her primary responsibilities, Nike was recently elected to the position of Director on the Chevron Employees Multipurpose Cooperative Society (CEMCS) Micro-Finance Bank and subsequently appointed as Board Chairperson. Prior to this, she had occupied the role of President of the Chevron Women's Employee Network Nigeria Mid-Africa Chapter and Chevron Nigeria Mid-Africa Agile Project Management Coach. She has also previously held the role of Global Director for Mentoring and Career Development for Chevron Corporation's new employees' network. Outside of work, she has served in the position of Secretary for the INSEAD Nigeria Alumni Association.",
      "Nike has a rare bouquet of talents and interests. A nationally recognized public speaker with speaking engagements including moderating sessions at the WIMBIZ Conference (Nigeria's largest conference for Women in Management, Business and Politics), she commits a large part of her spare time to coordinating community outreach projects and mentoring young students and graduates, most of whom are former trainees under Chevron's various internship programs."
    ]
  },
  'bio-amoo': {
    name: 'Mr. Tosin Amoo',
    role: 'Director',
    photo: '<?= APP_URL ?>/assets/images/directors/tosin-amoo.jpg',
    content: [
      "Tosin Amoo is a Technology expert with over two decades of experience leading digital and integration projects. He works with stakeholders and executives using systems and lateral thinking to develop innovative solutions to complex problems.",
      "Tosin is passionate about ethical technology use and its impact on public policy. With a keen interest in digital advocacy, he has championed studies in direct and constructive engagement of elected leaders and voters.",
      "Tosin has a remarkable ability to guide startups from their foundational stages to significant market recognition. With expertise in identifying promising ideas and opportunities, demonstrating a consistent aptitude for raising essential funding to nurture incubated concepts into thriving enterprises.",
      "A seasoned and engaging speaker, Tosin has established a distinguished reputation for presenting at conferences and delivering impactful insights to diverse audiences. Tosin earned an MBA from University of Lagos, and a degree in Electrical/Computer Engineering from FUT Minna.",
      "An avid tennis enthusiast, Tosin sponsors the Celltouch Open to raise the next generation of tennis players. He is involved in leadership roles in his community and regularly volunteers for social work."
    ]
  },
  'bio-esanubi': {
    name: 'Mr. Frank Esanubi',
    role: 'Director',
    photo: '<?= APP_URL ?>/assets/images/directors/frank-esanubi.jpg',
    content: [
      "Mr. Frank U. Esanubi holds Accounting, Business Administration and Financial Management degrees from Herriot-Watt University (Edinburgh), Oxford Brookes University (Oxford), Olabisi Onabanjo University (Ago-Iwoye) and Auchi Polytechnic (Auchi). He is currently a Decision Analyst at Chevron Nigeria Limited (CNL) where he is involved in capital investment analysis and appraisal, project performance and financial modeling and evaluation.",
      "Mr. Esanubi is a Fellow of the following professional bodies: Institute of Chartered Accountants of Nigeria (ICAN), Association of Chartered Certified Accountants (ACCA) and the Chartered Institute of Taxation of Nigeria (CITN). He was also a board member of Chevron Nigeria Closed PFA Limited from 2014–2017 and a former Acting President of the Petroleum and Natural Gas Senior Staff Association of Nigeria (PENGASSAN)."
    ]
  },
  'bio-olayisade': {
    name: 'Mr. Olayisade Adegboyega',
    role: 'Director',
    photo: '<?= APP_URL ?>/assets/images/directors/olayisade-adegboyega.jpg',
    content: [
      "Gboyega Olayisade is a seasoned finance professional with over twenty years of experience working at large multinational companies like Deloitte and Chevron, covering various locations in Africa and the United States. He has consistently demonstrated advanced proficiency in financial analysis, strategic planning, personnel management, and business process optimization.",
      "Gboyega holds a Degree in Accounting and a Master's Degree in Business Administration from reputable institutions. His academic background is complemented by a series of professional certifications and training programs that have equipped him with advanced skills in finance and management.",
      "He is a member of several professional organizations, including the Chartered Institute of Management Accountants (CIMA), Institute of Management Accountants (IMA), Information Systems Audit and Control Association (ISACA), the Chartered Institute of Taxation of Nigeria (CITN), and the Institute of Chartered Accountants of Nigeria (ICAN).",
      "In addition to his professional achievements, Gboyega is actively involved in community service and professional mentoring."
    ]
  },
  'bio-oni': {
    name: 'Ms. Seun Oni (INED)',
    role: 'Director',
    photo: '<?= APP_URL ?>/assets/images/directors/seun-oni.jpg',
    content: [
      "Ms. Seun Oni is an experienced Business Executive and an Independent Non-Executive Director who has served on the Board of Beta Glass Nigeria Plc and still serving on the Board of Continental Reinsurance Plc, a Non-Executive Director of Pikwik Nigeria and is the Group Managing Director/CEO of A.G. Leventis Nigeria Ltd (AGL).",
      "Ms. Seun Oni is a Business & Financial Management Executive, with 32 years' professional experience spanning Business Advisory, leading Financial Strategies & Processes in multinational organizations, Business Leadership and Board participation across different business sectors.",
      "Seun started her career in 1991 with Price Waterhouse (now PricewaterhouseCoopers). She moved into operational management in 1999, joining the Coca-Cola Company as Budget and Planning Manager for Coca-Cola Nigeria Limited, eventually being appointed as Executive Director and Country Finance Director in 2009.",
      "After a career spanning 18 years with the Coca-Cola System, Seun transitioned to Executive Finance Director of Reckitt Benckiser West Africa, before accepting the role of Group Managing Director/CEO for A.G. Leventis (AGL) Nigeria Ltd in September 2019.",
      "Seun is a Fellow of the Institute of Chartered Accountants of Nigeria and Chartered Institute of Directors. She holds an honours degree in Economics from the University of Lagos and is an alumna of Lagos Business School, Wharton Business School, IMD Business School Lausanne, and completed the Global CEO Program cohort 24 in May 2024. She is also a member of YPO Gold Africa and YPO Gold Lagos."
    ]
  },
  'bio-princewill': {
    name: 'Mr. Princewill Hope',
    role: 'Director',
    photo: '<?= APP_URL ?>/assets/images/directors/princewill-hope.jpg',
    content: [
      "Mr. Hope Princewill is a graduate of Mathematics and Computer Science from the University of Science and Technology, Port Harcourt. He also holds an MBA from the University of Arizona.",
      "He joined Chevron in 2009, and in his time in the Company, has worked in the company's assets in Nigeria and Overseas in varying capacities. Currently, he functions as Operations Coordinator in Chevron, with over 15 years' experience in production, projects, and budgets management.",
      "He is a member of Delta Mu Delta International Honor Society in Business, Lambda Sigma Chapter, and a Member of the Nigerian Institute of Management (Chartered). He is also the current President of the Chevron Employees Multipurpose Cooperative Society, Lagos."
    ]
  },
  'bio-adewale': {
    name: 'Abimbola Adewale',
    role: 'Managing Director',
    photo: '<?= APP_URL ?>/assets/images/directors/abimbola-adewale.jpg',
    content: [
      "Abimbola Adewale is a seasoned banking professional with over two decades of experience spanning diverse areas, including business strategy, banking operations, foreign exchange, relationship management, product development, non-interest banking, credit risk management, retail banking, public sector marketing, microfinance, training, and SME/small business segment management. His career journey includes roles at Habib Nigeria Bank, Oceanic Bank International, Unity Bank, and UNAAB Microfinance Bank Limited.",
      "Adewale is a well-rounded strategist with expertise in business development and relationship management. He has attended numerous professional courses locally and internationally, including the Micro, SME & Housing Finance Summer Academy at the Frankfurt School of Finance and Management, Germany; Advanced Microfinance Training at the School of African Microfinance, Kenya; Deutsche Bank Training in Alternative Finance, Trade Finance, and Letters of Credit; and Leadership courses at the Lagos Business School.",
      "A Chartered Banker (ACIB) and certified microfinance practitioner from the 2012 CBN/CIBN cohort, Adewale also holds an International Certified Expert qualification in Microfinance from the Frankfurt School of Finance and Management. He was a finalist for the prestigious 2018/2019 Hubert Humphrey Fellowship.",
      "Adewale is a member of the Chartered Institute of Bankers of Nigeria (CIBN) and the Chartered Institute of Loan and Risk Management of Nigeria. He holds a Second-Class Upper Degree in Accounting, a Postgraduate Diploma in Financial Management, and an MBA from Obafemi Awolowo University, Ile-Ife.",
      "Currently, he serves as the Vice President of Aquarians Club International and Treasurer of the Onward Club of Igbogila, demonstrating his commitment to leadership and community service."
    ]
  }
};

function openBio(id) {
  const bio = bios[id];
  if (!bio) return;
  const paragraphs = bio.content.map(p => `<p>${p}</p>`).join('');
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