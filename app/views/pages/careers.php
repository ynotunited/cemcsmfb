<!-- PAGE HEADER -->
<section class="page-header">
  <div class="wrap">
    <div class="page-header-inner">
      <div>
        <div class="page-header-badge reveal">
          <span class="badge-dot" style="animation: pulse 2s infinite;"></span>
          <span class="label">Join Our Team</span>
        </div>
        <h1 class="page-title reveal d1">Build Your <br /><span class="text-gradient">Career</span></h1>
      </div>
      <p class="page-desc">
        If you're ambitious, innovative and hard working, a career with CEMCS Microfinance Bank may be for you.
      </p>
    </div>
  </div>
</section>

<!-- WHY JOIN SECTION -->
<section class="section">
  <div class="wrap">
    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: var(--s16);">
      <!-- LEFT COLUMN -->
      <div class="reveal">
        <p class="label">Why CEMCS MFB</p>
        <h2 class="h-lg">A culture that's diverse, dynamic and focused on your success.</h2>
        
        <div style="margin-top: var(--s8);">
          <div class="careers-why-point">
            <div class="careers-why-icon">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <polyline points="20 6 9 17 4 12"></polyline>
              </svg>
            </div>
            <p>Surrounded by exceptional thinkers with access to real opportunities from day one</p>
          </div>
          
          <div class="careers-why-point">
            <div class="careers-why-icon">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <polyline points="20 6 9 17 4 12"></polyline>
              </svg>
            </div>
            <p>Equal opportunity employer — we don't discriminate on any legally protected basis</p>
          </div>
          
          <div class="careers-why-point">
            <div class="careers-why-icon">
              <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <polyline points="20 6 9 17 4 12"></polyline>
              </svg>
            </div>
            <p>Exciting, stimulating and challenging work in a growing microfinance sector</p>
          </div>
        </div>
      </div>
      
      <!-- RIGHT COLUMN -->
      <div class="reveal d1">
        <div style="background: var(--n-900); border-radius: var(--r-lg); padding: var(--s8); color: white;">
          <h3 style="font-size: var(--t-xl); font-weight: 700; margin-bottom: var(--s4);">Equal Opportunity Employer</h3>
          <p style="margin-bottom: var(--s4); line-height: var(--lh-relaxed);">
            CEMCS Microfinance Bank is committed to providing equal employment opportunities to all qualified individuals without regard to race, color, religion, sex, national origin, age, disability, or any other legally protected status.
          </p>
          <p style="font-size: var(--t-sm); color: var(--n-300);">
            Ready to join our team? Send your resume to <a href="mailto:info@cemcsmfb.com" style="color: var(--brand-blue-light); text-decoration: underline;">info@cemcsmfb.com</a>
          </p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- OPEN VACANCIES SECTION -->
<section class="section" style="background: var(--n-50);">
  <div class="wrap">
    <p class="label">Current Openings</p>
    <h2 class="h-lg">Open Vacancies</h2>
    
    <div class="jobs-grid">
      <!-- JOB 1: IT -->
      <div class="job-card">
        <div class="job-card-top">
          <h3 class="job-title">Deputy Head, Information Technology</h3>
          <span class="job-chip">Technology</span>
        </div>
        <p class="body-sm">Oversee strategic and operational management of IT infrastructure, software systems, and IT policies. BankOne proficiency mandatory.</p>
        <p class="job-deadline">Deadline: April 3rd, 2026</p>
        <button class="btn btn-primary" style="width: 100%;" onclick="openJobModal('job-it')">View Details & Apply</button>
      </div>
      
      <!-- JOB 2: HR -->
      <div class="job-card">
        <div class="job-card-top">
          <h3 class="job-title">HR Lead</h3>
          <span class="job-chip">Human Resources</span>
        </div>
        <p class="body-sm">Support the HR function in a regulated microfinance environment — recruitment, onboarding, employee relations, payroll and compliance.</p>
        <p class="job-deadline">Deadline: April 3rd, 2026</p>
        <button class="btn btn-primary" style="width: 100%;" onclick="openJobModal('job-hr')">View Details & Apply</button>
      </div>
      
      <!-- JOB 3: Marketing -->
      <div class="job-card">
        <div class="job-card-top">
          <h3 class="job-title">Marketing / Relationship Officer</h3>
          <span class="job-chip">Sales & Marketing</span>
        </div>
        <p class="body-sm">Drive sustainable growth of the Bank's deposit base and risk assets, focusing on SMEs and women-owned enterprises.</p>
        <p class="job-deadline">Deadline: April 3rd, 2026</p>
        <button class="btn btn-primary" style="width: 100%;" onclick="openJobModal('job-mkt')">View Details & Apply</button>
      </div>
    </div>
  </div>
</section>

<!-- CV SUBMISSION FORM SECTION -->
<section class="section">
  <div class="wrap" style="max-width: 800px; margin: 0 auto;">
    <p class="label">Apply Now</p>
    <h2 class="h-lg">Submit Your Application</h2>
    <p class="body-lg" style="margin-bottom: var(--s8);">Fill in the form below and attach your CV. We'll review your application and get back to you.</p>
    
    <form id="cv-form" method="POST" enctype="multipart/form-data" action="#">
      <?= CsrfHelper::field() ?>
      <input type="hidden" name="g-recaptcha-response" id="cv-recaptcha-token">
      
      <div style="display: grid; grid-template-columns: 1fr 1fr; gap: var(--s4); margin-bottom: var(--s4);">
        <div>
          <label for="full_name" class="form-label">Full Name *</label>
          <input type="text" id="full_name" name="full_name" class="form-control" required>
        </div>
        <div>
          <label for="email" class="form-label">Email *</label>
          <input type="email" id="email" name="email" class="form-control" required>
        </div>
      </div>
      
      <div style="display: grid; grid-template-columns: 1fr 1fr; gap: var(--s4); margin-bottom: var(--s4);">
        <div>
          <label for="phone" class="form-label">Phone</label>
          <input type="tel" id="phone" name="phone" class="form-control">
        </div>
        <div>
          <label for="whatsapp" class="form-label">WhatsApp Number</label>
          <input type="tel" id="whatsapp" name="whatsapp" class="form-control" placeholder="+234...">
        </div>
      </div>
      
      <div style="margin-bottom: var(--s4);">
        <label for="position" class="form-label">Position Applying For *</label>
        <select id="position" name="position" class="form-control" required>
          <option value="">-- Select Position --</option>
          <option value="Deputy Head, Information Technology">Deputy Head, Information Technology</option>
          <option value="HR Lead">HR Lead</option>
          <option value="Marketing/Relationship Officer">Marketing/Relationship Officer</option>
          <option value="General Application">General Application</option>
        </select>
      </div>
      
      <div style="margin-bottom: var(--s4);">
        <label for="cv_file" class="form-label">CV / Resume Upload *</label>
        <div class="upload-zone" id="upload-zone" onclick="document.getElementById('cv_file').click()">
          <input type="file" id="cv_file" name="cv_file" accept=".pdf,.doc,.docx" required style="display: none;">
          <div id="upload-text">
            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="margin: 0 auto var(--s2);">
              <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
              <polyline points="17 8 12 3 7 8"></polyline>
              <line x1="12" y1="3" x2="12" y2="15"></line>
            </svg>
            <p style="font-weight: 600; margin-bottom: var(--s1);">Click to upload your CV</p>
            <p style="font-size: var(--t-sm); color: var(--txt-3);">PDF, DOC, or DOCX (max 5MB)</p>
          </div>
        </div>
      </div>
      
      <div style="margin-bottom: var(--s6);">
        <label for="cover_note" class="form-label">Cover Note</label>
        <textarea id="cover_note" name="cover_note" class="form-control" rows="4" placeholder="Brief note about yourself and why you're a good fit..."></textarea>
      </div>
      
      <button type="submit" class="btn btn-primary btn-lg" id="cv-submit-btn" style="width: 100%;">Submit Application</button>
      
      <!-- SUCCESS STATE -->
      <div id="cv-success" style="display: none; text-align: center; padding: var(--s8); background: var(--green-bg); border-radius: var(--r-lg); margin-top: var(--s6);">
        <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="var(--green)" stroke-width="2" style="margin: 0 auto var(--s4);">
          <circle cx="12" cy="12" r="10"></circle>
          <polyline points="16 8 10 14 8 12"></polyline>
        </svg>
        <h3 style="font-size: var(--t-2xl); font-weight: 700; margin-bottom: var(--s3); color: var(--green);">Application Submitted!</h3>
        <p style="margin-bottom: var(--s2);">Thank you <span id="applicant-name"></span>. We've received your application and will be in touch.</p>
        <p style="font-size: var(--t-sm); color: var(--txt-3);">You should receive a confirmation email shortly.</p>
      </div>
    </form>
  </div>
</section>

<!-- JOB DETAIL MODAL -->
<div id="job-modal" class="modal-overlay">
  <div class="modal-content">
    <button class="modal-close" onclick="closeJobModal()">&times;</button>
    <div id="job-body"></div>
  </div>
</div>

<style>
.careers-why-point {
  display: flex;
  gap: var(--s4);
  align-items: flex-start;
  margin-bottom: var(--s5);
}

.careers-why-icon {
  width: 36px;
  height: 36px;
  background: var(--brand-blue-light);
  border-radius: var(--r-md);
  display: flex;
  align-items: center;
  justify-content: center;
  color: var(--brand-blue);
  flex-shrink: 0;
}

.jobs-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: var(--s6);
  margin-top: var(--s10);
}

.job-card {
  background: var(--surface);
  border: 1px solid var(--border);
  border-radius: var(--r-lg);
  padding: var(--s8);
  display: flex;
  flex-direction: column;
  gap: var(--s4);
  transition: box-shadow var(--t-base) var(--ease-o), transform var(--t-base) var(--ease-o);
}

.job-card:hover {
  box-shadow: var(--s-3);
  transform: translateY(-3px);
}

.job-card-top {
  display: flex;
  justify-content: space-between;
  align-items: flex-start;
  gap: var(--s3);
}

.job-chip {
  font-family: var(--f-mono);
  font-size: var(--t-xs);
  font-weight: 500;
  background: var(--brand-blue-light);
  color: var(--brand-blue);
  padding: 3px 10px;
  border-radius: var(--r-sm);
  white-space: nowrap;
  flex-shrink: 0;
}

.job-title {
  font-family: var(--f-display);
  font-size: var(--t-xl);
  font-weight: 700;
  letter-spacing: -0.01em;
  color: var(--txt-1);
  line-height: var(--lh-snug);
}

.job-deadline {
  font-family: var(--f-mono);
  font-size: var(--t-xs);
  color: var(--txt-3);
}

.upload-zone {
  border: 2px dashed var(--border);
  border-radius: var(--r-md);
  padding: var(--s6);
  text-align: center;
  cursor: pointer;
  transition: border-color var(--t-fast) var(--ease-o);
}

.upload-zone:hover {
  border-color: var(--brand-blue);
}

.upload-zone.has-file {
  border-color: var(--green);
  background: var(--green-bg);
}

@media (max-width: 1024px) {
  .jobs-grid {
    grid-template-columns: 1fr 1fr;
  }
}

@media (max-width: 640px) {
  .jobs-grid {
    grid-template-columns: 1fr;
  }
}
</style>

<script>
const jobDetails = {
  'job-it': {
    title: 'Deputy Head, Information Technology',
    department: 'Technology',
    summary: 'The IT Team Lead will be responsible for overseeing the strategic and operational management of the organization\'s technology infrastructure, software systems, and IT policies.',
    qualifications: [
      'Minimum of B.Sc or HND in Computer Science, Information Technology, or a related field.',
      'Relevant professional certifications in the IT field are required.',
      'At least 5 years of relevant experience in a Microfinance/Commercial Bank, with proven leadership as Head of IT.',
      'Proficiency and experience in the use of BankOne software is mandatory.',
      'Strong networking capabilities and technical troubleshooting skills.'
    ],
    responsibilities: [
      'Product & Vendor Management',
      'Hardware & Software Administration',
      'Network Management',
      'Information Security'
    ],
    skills: [
      'Advanced proficiency in BankOne software',
      'Expertise in cybersecurity and blockchain technologies',
      'Strong networking skills (LAN/Wireless)',
      'Effective leadership, collaboration, and adaptability'
    ]
  },
  'job-hr': {
    title: 'HR Lead',
    department: 'Human Resources',
    summary: 'Support the HR function in a regulated microfinance environment by delivering efficient recruitment support, onboarding, employee relations, payroll/benefits administration, training coordination, and compliance documentation.',
    qualifications: [
      'Bachelor\'s degree in HR Management, Industrial Relations, Business Administration, Psychology, or Law.',
      'Professional certifications: CIPM (Nigeria), or SHRM, or HRCI preferred.',
      '3–5 years HR support experience in banking/financial services.',
      'Knowledge of Nigeria Labour Act, Pension Reform Act, NDPR, and CBN Microfinance Guidelines.',
      'Proficiency in Microsoft 365 tools; HRIS is an added advantage.'
    ],
    responsibilities: [
      'Talent Acquisition & Onboarding',
      'HR Administration & HRIS',
      'Payroll & Benefits Support',
      'Employee Relations & Culture',
      'Performance & Learning Support'
    ],
    skills: []
  },
  'job-mkt': {
    title: 'Marketing / Relationship Officer',
    department: 'Sales & Marketing',
    summary: 'Drive sustainable growth of the Bank\'s deposit base and risk assets in compliance with CBN Guidelines for Microfinance Banks, by marketing approved financial products and acquiring quality customers.',
    qualifications: [
      'Minimum of HND/BSc in a relevant discipline (Upper Credit - HND or 2:1 for B.Sc.).',
      '2-3 years work experience in a financial service or Microfinance Institution.',
      '5 years post-graduation experience.',
      'Proficiency in Microsoft 365, BankOne Software.',
      'Strong sales, communication and relationship management skills.'
    ],
    responsibilities: [
      'Product Marketing & Deposit Mobilization',
      'Business Development & Customer Acquisition',
      'Loan Asset Creation & Credit Administration',
      'Loan Monitoring, Repayment & Recovery',
      'Relationship Management & Service Quality'
    ],
    skills: []
  }
};

function openJobModal(id) {
  const job = jobDetails[id];
  if (!job) return;
  
  const qualsList = job.qualifications.map(q => `<li>${q}</li>`).join('');
  const respList = job.responsibilities.map(r => `<li>${r}</li>`).join('');
  const skillsSection = job.skills.length > 0 
    ? `<div style="margin-top: var(--s6);"><h3 style="font-size: var(--t-lg); font-weight: 700; margin-bottom: var(--s3);">Key Skills</h3><ul style="list-style: disc; padding-left: var(--s5); line-height: var(--lh-relaxed);">${job.skills.map(s => `<li>${s}</li>`).join('')}</ul></div>`
    : '';
  
  document.getElementById('job-body').innerHTML =
    '<div class="modal-hero" style="border-bottom: 1px solid var(--border); padding-bottom: var(--s6); margin-bottom: var(--s6);">' +
      '<div>' +
        '<span class="job-chip" style="display: inline-block; margin-bottom: var(--s3);">' + job.department + '</span>' +
        '<h2 style="font-size: var(--t-3xl); font-weight: 700; margin-bottom: var(--s2);">' + job.title + '</h2>' +
      '</div>' +
    '</div>' +
    '<div class="modal-body">' +
      '<div style="margin-bottom: var(--s6);">' +
        '<h3 style="font-size: var(--t-lg); font-weight: 700; margin-bottom: var(--s3);">Summary</h3>' +
        '<p style="line-height: var(--lh-relaxed);">' + job.summary + '</p>' +
      '</div>' +
      '<div style="margin-bottom: var(--s6);">' +
        '<h3 style="font-size: var(--t-lg); font-weight: 700; margin-bottom: var(--s3);">Qualifications</h3>' +
        '<ul style="list-style: disc; padding-left: var(--s5); line-height: var(--lh-relaxed);">' + qualsList + '</ul>' +
      '</div>' +
      '<div style="margin-bottom: var(--s6);">' +
        '<h3 style="font-size: var(--t-lg); font-weight: 700; margin-bottom: var(--s3);">Responsibilities</h3>' +
        '<ul style="list-style: disc; padding-left: var(--s5); line-height: var(--lh-relaxed);">' + respList + '</ul>' +
      '</div>' +
      skillsSection +
      '<div style="background: var(--n-50); border-radius: var(--r-lg); padding: var(--s6); margin-top: var(--s8);">' +
        '<p style="font-family: var(--f-mono); font-size: var(--t-sm); font-weight: 600; color: var(--txt-2); margin-bottom: var(--s3);">Deadline: April 3rd, 2026</p>' +
        '<p style="font-size: var(--t-sm); color: var(--txt-3);">Apply using the form below or send your CV to <a href="mailto:info@cemcsmfb.com" style="color: var(--brand-blue); text-decoration: underline;">info@cemcsmfb.com</a></p>' +
      '</div>' +
    '</div>';
  
  // Auto-populate position select
  const positionSelect = document.getElementById('position');
  if (positionSelect) {
    positionSelect.value = job.title;
  }
  
  document.getElementById('job-modal').classList.add('active');
  document.body.style.overflow = 'hidden';
  
  // Scroll to form after a brief delay
  setTimeout(() => {
    const form = document.getElementById('cv-form');
    if (form) {
      form.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }
  }, 300);
}

function closeJobModal() {
  document.getElementById('job-modal').classList.remove('active');
  document.body.style.overflow = '';
}

// Upload zone file handling
document.getElementById('cv_file').addEventListener('change', function(e) {
  const zone = document.getElementById('upload-zone');
  const text = document.getElementById('upload-text');
  
  if (this.files && this.files[0]) {
    const fileName = this.files[0].name;
    const fileSize = (this.files[0].size / 1024 / 1024).toFixed(2);
    
    zone.classList.add('has-file');
    text.innerHTML = 
      '<svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="var(--green)" stroke-width="2" style="margin: 0 auto var(--s2);">' +
        '<path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>' +
        '<polyline points="13 2 13 9 20 9"></polyline>' +
      '</svg>' +
      '<p style="font-weight: 600; margin-bottom: var(--s1); color: var(--green);">' + fileName + '</p>' +
      '<p style="font-size: var(--t-sm); color: var(--txt-3);">' + fileSize + ' MB</p>';
  }
});

// CV Form submission
document.getElementById('cv-form').addEventListener('submit', function(e) {
  e.preventDefault();
  
  const siteKey = '<?= htmlspecialchars($recaptcha_site_key ?? '') ?>';
  const submitBtn = document.getElementById('cv-submit-btn');
  
  submitBtn.disabled = true;
  submitBtn.textContent = 'Submitting...';
  
  if (typeof grecaptcha !== 'undefined' && siteKey) {
    grecaptcha.ready(function() {
      grecaptcha.execute(siteKey, { action: 'cv_application' }).then(function(token) {
        doSubmit(token);
      });
    });
  } else {
    doSubmit('');
  }
  
  function doSubmit(token) {
    document.getElementById('cv-recaptcha-token').value = token;
    
    const formData = new FormData(document.getElementById('cv-form'));
    
    fetch('<?= APP_URL ?>/api/cv-application', {
      method: 'POST',
      body: formData
    })
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        // Hide form sections
        const formElements = document.querySelectorAll('#cv-form > div, #cv-form > button');
        formElements.forEach(el => el.style.display = 'none');
        
        // Show success message
        const successDiv = document.getElementById('cv-success');
        const applicantName = document.getElementById('full_name').value.split(' ')[0];
        document.getElementById('applicant-name').textContent = applicantName;
        successDiv.style.display = 'block';
        
        // Scroll to success message
        successDiv.scrollIntoView({ behavior: 'smooth', block: 'center' });
      } else {
        alert(data.message || 'An error occurred. Please try again.');
        submitBtn.disabled = false;
        submitBtn.textContent = 'Submit Application';
      }
    })
    .catch(error => {
      console.error('Error:', error);
      alert('An error occurred. Please try again.');
      submitBtn.disabled = false;
      submitBtn.textContent = 'Submit Application';
    });
  }
});

// Modal keyboard and backdrop close
window.addEventListener('keydown', e => { if (e.key === 'Escape') closeJobModal(); });
document.getElementById('job-modal').addEventListener('click', e => { if (e.target.id === 'job-modal') closeJobModal(); });
</script>
