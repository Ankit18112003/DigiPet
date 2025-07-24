<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>DigiPet Portal</title>

  <!-- TailwindCSS -->
  <script src="https://cdn.tailwindcss.com"></script>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

  <style>
    html { scroll-behavior: smooth; }
    @keyframes fadeInUp {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }
    .animate-fadeInUp { animation: fadeInUp 1s ease-out both; }

    /* Full viewport height for initial view including header */
    .landing-area {
      height: 100vh;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }
    
    /* Hero section takes remaining space after header */
    .hero-container {
      flex: 1;
      position: relative;
    }

    /* Input styling for contact form */
    .form-input {
      border: 2px solid #cbd5e0;
      background-color: #f9fafb;
      padding: 0.75rem 1rem;
      width: 100%;
      border-radius: 0.5rem;
      transition: all 0.3s ease;
      font-size: 1rem;
    }
    .form-input:focus {
      border-color: #38a169;
      background-color: #fff;
      box-shadow: 0 0 0 3px rgba(72,187,120,0.3);
      outline: none;
    }

    /* Buttons */
    .scroll-btn, .help-btn {
      position: fixed;
      width: 3rem; height: 3rem;
      display: flex; align-items: center; justify-content: center;
      border-radius: 9999px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.3);
      transition: all 0.3s;
      z-index: 50;
    }
    .scroll-btn { bottom: 1.5rem; right: 1.5rem; background: #22543d; color: #fff; }
    .scroll-btn:hover { background: #2f855a; }
    .help-btn { bottom: 1.5rem; left: 1.5rem; background: #ecc94b; color: #1a202c; }
    .help-btn:hover { background: #d69e2e; }

    /* Remove space between sections */
    section {
      margin: 0;
      padding: 0;
    }
    
    /* Section content padding */
    .section-content {
      padding: 5rem 1.5rem;
    }

    /* Footer gradient */
    footer {
      background: linear-gradient(rgba(29,77,53,0.95), rgba(29,77,53,0.95));
      color: #fff;
    }
  </style>
</head>
<body class="bg-gray-100 text-green-900">

  <!-- Landing Area (Header + Hero) -->
  <div class="landing-area">
    <!-- Header -->
    <header class="bg-green-900 text-white py-3 shadow-md">
      <div class="container mx-auto flex items-center justify-between px-6">
        <div class="flex items-center gap-2">
          <img src="/assets/dog-logo.png" alt="Logo" class="w-8 h-8 rounded-full bg-white p-1"/>
          <h1 class="text-2xl font-semibold text-yellow-400">DigiPet Portal</h1>
        </div>
        <nav class="hidden md:flex space-x-6">
          <a href="#hero" class="hover:text-yellow-400">Home</a>
          <a href="#features" class="hover:text-yellow-400">Features</a>
          <a href="#team" class="hover:text-yellow-400">Team</a>
          <a href="#feedback" class="hover:text-yellow-400">Feedback</a>
          <a href="#metrics" class="hover:text-yellow-400">Metrics</a>
          <a href="#faq" class="hover:text-yellow-400">FAQ</a>
          <a href="#contact" class="hover:text-yellow-400">Contact</a>
        </nav>
        <button class="md:hidden text-white" id="mobileMenuButton">
          <i class="fas fa-bars text-2xl"></i>
        </button>
      </div>
    </header>

    <!-- Mobile Menu -->
    <div id="mobileMenu" class="md:hidden fixed inset-0 bg-green-900 z-50 hidden">
      <div class="container mx-auto p-6 flex flex-col h-full">
        <button class="self-end text-white text-2xl mb-8">
          <i class="fas fa-times"></i>
        </button>
        <nav class="flex flex-col space-y-6 text-xl text-center">
          <a href="#hero" class="text-white hover:text-yellow-400 py-2">Home</a>
          <a href="#features" class="text-white hover:text-yellow-400 py-2">Features</a>
          <a href="#team" class="text-white hover:text-yellow-400 py-2">Team</a>
          <a href="#feedback" class="text-white hover:text-yellow-400 py-2">Feedback</a>
          <a href="#metrics" class="text-white hover:text-yellow-400 py-2">Metrics</a>
          <a href="#faq" class="text-white hover:text-yellow-400 py-2">FAQ</a>
          <a href="#contact" class="text-white hover:text-yellow-400 py-2">Contact</a>
        </nav>
      </div>
    </div>

    <!-- Hero Section -->
    <section id="hero" class="hero-container relative overflow-hidden bg-gray-100">
      <div class="absolute inset-0 bg-green-900/30 z-0"></div>
      
      <div class="relative z-10 h-full flex items-center justify-center">
        <div class="text-center p-6 max-w-4xl mx-auto animate-fadeInUp">
          <h1 class="text-4xl md:text-6xl font-extrabold mb-6 text-white drop-shadow-lg">
            <span class="text-yellow-400">Digital Care</span> for Your Beloved Pets
          </h1>
          <p class="text-xl md:text-2xl mb-8 text-white/90 font-medium">
            The complete platform for pet registration, health tracking, and veterinary access
          </p>
          <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="/register" class="bg-yellow-400 hover:bg-yellow-500 text-green-900 py-3 px-8 rounded-full font-bold transition transform hover:scale-105 shadow-lg">
              Register Your Pet <i class="fas fa-paw ml-2"></i>
            </a>
            <a href="#features" class="bg-white/90 hover:bg-white text-green-900 py-3 px-8 rounded-full font-bold transition transform hover:scale-105 shadow-lg">
              Learn More <i class="fas fa-chevron-down ml-2"></i>
            </a>
          </div>
        </div>
      </div>
      
      <!-- Centered scroll down arrow -->
      <div class="absolute bottom-4 left-0 right-0 text-center animate-bounce">
        <a href="#features" class="inline-block p-2 rounded-full bg-white/20 hover:bg-white/30 transition">
          <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/>
          </svg>
        </a>
      </div>
    </section>
  </div>

  <!-- Features -->
  <section id="features" class="bg-white">
    <div class="section-content container mx-auto">
      <div class="text-center mb-16">
        <span class="inline-block px-4 py-1 bg-green-100 text-green-800 rounded-full text-sm font-semibold mb-4">WHY CHOOSE US</span>
        <h2 class="text-4xl font-bold mb-6">Comprehensive Pet Management</h2>
        <p class="max-w-2xl mx-auto text-lg text-gray-600">Everything you need to keep your pets healthy and compliant with regulations</p>
      </div>

      <div class="grid md:grid-cols-3 gap-10">
        <div class="bg-green-50 p-8 rounded-xl hover:shadow-lg transition-all duration-300 transform hover:-translate-y-2">
          <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mb-6 text-green-800">
            <i class="fas fa-paw text-2xl"></i>
          </div>
          <h3 class="text-xl font-bold mb-3">Pet Registration</h3>
          <p class="text-gray-600">Quick and easy digital registration with government-compliant documentation</p>
        </div>
        
        <div class="bg-green-50 p-8 rounded-xl hover:shadow-lg transition-all duration-300 transform hover:-translate-y-2">
          <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mb-6 text-green-800">
            <i class="fas fa-user-md text-2xl"></i>
          </div>
          <h3 class="text-xl font-bold mb-3">Veterinarian Access</h3>
          <p class="text-gray-600">Direct access to your pet's health records by authorized veterinarians</p>
        </div>
        
        <div class="bg-green-50 p-8 rounded-xl hover:shadow-lg transition-all duration-300 transform hover:-translate-y-2">
          <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mb-6 text-green-800">
            <i class="fas fa-chart-line text-2xl"></i>
          </div>
          <h3 class="text-xl font-bold mb-3">Health Analytics</h3>
          <p class="text-gray-600">Track vaccinations, medications, and health trends over time</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Team -->
  <section id="team" class="bg-green-100">
    <div class="section-content container mx-auto">
      <div class="text-center mb-16">
        <span class="inline-block px-4 py-1 bg-green-200 text-green-800 rounded-full text-sm font-semibold mb-4">OUR EXPERTS</span>
        <h2 class="text-4xl font-bold mb-6">Meet Our Dedicated Team</h2>
        <p class="max-w-2xl mx-auto text-lg text-gray-700">Professionals committed to pet health and digital innovation</p>
      </div>

      <div class="flex flex-wrap justify-center gap-8">
        <div class="bg-white p-6 rounded-xl shadow-md text-center w-72 transform hover:scale-105 transition duration-300">
          <div class="w-32 h-32 mx-auto mb-4 rounded-full bg-green-100 flex items-center justify-center text-green-800">
            <i class="fas fa-user-tie text-4xl"></i>
          </div>
          <h3 class="text-xl font-bold">Sahil Chari</h3>
          <p class="text-sm text-green-700 mb-3">Project Lead & Analyst</p>
          <p class="text-gray-600 text-sm">10+ years in pet tech solutions</p>
          <div class="flex justify-center gap-3 mt-4">
            <a href="#" class="text-green-600 hover:text-green-800"><i class="fab fa-linkedin"></i></a>
            <a href="#" class="text-green-600 hover:text-green-800"><i class="fab fa-twitter"></i></a>
          </div>
        </div>
        
        <div class="bg-white p-6 rounded-xl shadow-md text-center w-72 transform hover:scale-105 transition duration-300">
          <div class="w-32 h-32 mx-auto mb-4 rounded-full bg-green-100 flex items-center justify-center text-green-800">
            <i class="fas fa-paint-brush text-4xl"></i>
          </div>
          <h3 class="text-xl font-bold">Ankit Kumar Singh</h3>
          <p class="text-sm text-green-700 mb-3">UI/UX Designer</p>
          <p class="text-gray-600 text-sm">Pet lover and design expert</p>
          <div class="flex justify-center gap-3 mt-4">
            <a href="#" class="text-green-600 hover:text-green-800"><i class="fab fa-linkedin"></i></a>
            <a href="#" class="text-green-600 hover:text-green-800"><i class="fab fa-twitter"></i></a>
          </div>
        </div>
        
        <div class="bg-white p-6 rounded-xl shadow-md text-center w-72 transform hover:scale-105 transition duration-300">
          <div class="w-32 h-32 mx-auto mb-4 rounded-full bg-green-100 flex items-center justify-center text-green-800">
            <i class="fas fa-user-md text-4xl"></i>
          </div>
          <h3 class="text-xl font-bold">Sitesh Naik</h3>
          <p class="text-sm text-green-700 mb-3">Web Developer</p>
          <p class="text-gray-600 text-sm">15+ years web development experience</p>
          <div class="flex justify-center gap-3 mt-4">
            <a href="#" class="text-green-600 hover:text-green-800"><i class="fab fa-linkedin"></i></a>
            <a href="#" class="text-green-600 hover:text-green-800"><i class="fab fa-twitter"></i></a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Feedback -->
  <section id="feedback" class="bg-white">
    <div class="section-content container mx-auto">
      <div class="text-center mb-16">
        <span class="inline-block px-4 py-1 bg-green-100 text-green-800 rounded-full text-sm font-semibold mb-4">TESTIMONIALS</span>
        <h2 class="text-4xl font-bold mb-6">Trusted by Pet Owners</h2>
      </div>
      
      <div class="flex flex-wrap justify-center gap-8">
        <div class="bg-green-50 p-8 rounded-xl shadow-lg max-w-sm">
          <div class="flex items-center mb-6">
            <div class="w-16 h-16 rounded-full bg-green-100 flex items-center justify-center mr-4 text-green-800">
              <i class="fas fa-user text-2xl"></i>
            </div>
            <div>
              <h4 class="font-bold">Sneha</h4>
              <div class="flex text-yellow-400">
                <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
              </div>
            </div>
          </div>
          <p class="text-lg italic">"DigiPet made registration super easy. I can now access all my dog's vaccination records in one place. Highly recommended!"</p>
        </div>
        
        <div class="bg-green-50 p-8 rounded-xl shadow-lg max-w-sm">
          <div class="flex items-center mb-6">
            <div class="w-16 h-16 rounded-full bg-green-100 flex items-center justify-center mr-4 text-green-800">
              <i class="fas fa-user-md text-2xl"></i>
            </div>
            <div>
              <h4 class="font-bold">Dr. Mehta</h4>
              <div class="flex text-yellow-400">
                <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
              </div>
            </div>
          </div>
          <p class="text-lg italic">"As a veterinarian, the seamless access to pet health records has transformed how I deliver care to my patients."</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Success Metrics -->
  <section id="metrics" class="bg-green-800 text-white">
    <div class="section-content container mx-auto">
      <div class="text-center mb-16">
        <span class="inline-block px-4 py-1 bg-yellow-400 text-green-900 rounded-full text-sm font-semibold mb-4">OUR IMPACT</span>
        <h2 class="text-4xl font-bold mb-6">Proven Results</h2>
        <p class="max-w-2xl mx-auto text-lg text-green-100">Numbers that showcase our platform's effectiveness</p>
      </div>

      <div class="grid md:grid-cols-4 gap-8 text-center">
        <!-- Metric 1 -->
        <div class="bg-green-900/50 p-8 rounded-xl hover:shadow-lg transition-all duration-300 transform hover:scale-105">
          <div class="text-5xl font-bold text-yellow-400 mb-3">10K+</div>
          <h3 class="text-xl font-semibold mb-2">Pets Registered</h3>
          <p class="text-green-200">Happy pets with digital IDs</p>
        </div>
        
        <!-- Metric 2 -->
        <div class="bg-green-900/50 p-8 rounded-xl hover:shadow-lg transition-all duration-300 transform hover:scale-105">
          <div class="text-5xl font-bold text-yellow-400 mb-3">98%</div>
          <h3 class="text-xl font-semibold mb-2">Vaccination Rate</h3>
          <p class="text-green-200">Timely vaccination reminders</p>
        </div>
        
        <!-- Metric 3 -->
        <div class="bg-green-900/50 p-8 rounded-xl hover:shadow-lg transition-all duration-300 transform hover:scale-105">
          <div class="text-5xl font-bold text-yellow-400 mb-3">500+</div>
          <h3 class="text-xl font-semibold mb-2">Veterinarians</h3>
          <p class="text-green-200">Trusted professionals onboard</p>
        </div>
        
        <!-- Metric 4 -->
        <div class="bg-green-900/50 p-8 rounded-xl hover:shadow-lg transition-all duration-300 transform hover:scale-105">
          <div class="text-5xl font-bold text-yellow-400 mb-3">4.9★</div>
          <h3 class="text-xl font-semibold mb-2">Average Rating</h3>
          <p class="text-green-200">From pet owners</p>
        </div>
      </div>

      <div class="mt-16 text-center">
        <a href="/register" class="inline-block bg-yellow-400 hover:bg-yellow-500 text-green-900 font-bold py-3 px-8 rounded-full transition transform hover:scale-105 shadow-lg">
          Join Our Community <i class="fas fa-paw ml-2"></i>
        </a>
      </div>
    </div>
  </section>

  <!-- FAQs -->
  <section id="faq" class="bg-green-50">
    <div class="section-content container mx-auto">
      <h3 class="text-4xl font-bold text-center mb-10">Frequently Asked Questions</h3>
      <div class="max-w-3xl mx-auto space-y-4">
        <details class="bg-white p-6 rounded-lg shadow hover:shadow-md transition duration-300">
          <summary class="cursor-pointer font-medium text-lg flex justify-between items-center">
            <span>How do I register my pet?</span>
            <i class="fas fa-chevron-down transition-transform duration-300"></i>
          </summary>
          <p class="mt-4 text-gray-600">Click Get Started and fill in your pet's details. The process takes less than 5 minutes.</p>
        </details>
        
        <details class="bg-white p-6 rounded-lg shadow hover:shadow-md transition duration-300">
          <summary class="cursor-pointer font-medium text-lg flex justify-between items-center">
            <span>Is there a mobile app available?</span>
            <i class="fas fa-chevron-down transition-transform duration-300"></i>
          </summary>
          <p class="mt-4 text-gray-600">Yes! Our mobile app is available for both iOS and Android devices.</p>
        </details>
        
        <details class="bg-white p-6 rounded-lg shadow hover:shadow-md transition duration-300">
          <summary class="cursor-pointer font-medium text-lg flex justify-between items-center">
            <span>How much does it cost to register?</span>
            <i class="fas fa-chevron-down transition-transform duration-300"></i>
          </summary>
          <p class="mt-4 text-gray-600">Basic registration is completely free. Premium features are available with a small monthly subscription.</p>
        </details>
        
        <details class="bg-white p-6 rounded-lg shadow hover:shadow-md transition duration-300">
          <summary class="cursor-pointer font-medium text-lg flex justify-between items-center">
            <span>Can multiple pets be registered?</span>
            <i class="fas fa-chevron-down transition-transform duration-300"></i>
          </summary>
          <p class="mt-4 text-gray-600">Absolutely! You can register all your pets under one account.</p>
        </details>
        
        <details class="bg-white p-6 rounded-lg shadow hover:shadow-md transition duration-300">
          <summary class="cursor-pointer font-medium text-lg flex justify-between items-center">
            <span>How do I update my pet's information?</span>
            <i class="fas fa-chevron-down transition-transform duration-300"></i>
          </summary>
          <p class="mt-4 text-gray-600">You can edit your pet's details anytime through your account dashboard.</p>
        </details>
      </div>
    </div>
  </section>

  <!-- Contact -->
  <section id="contact" class="bg-white">
    <div class="section-content container mx-auto">
      <h3 class="text-4xl font-bold text-center mb-12">Get in Touch</h3>
      <div class="max-w-lg mx-auto bg-gray-50 p-8 rounded-xl shadow-lg">
        <form class="space-y-6">
          <div class="grid md:grid-cols-2 gap-6">
            <div>
              <input type="text" placeholder="Your Name" class="form-input" required>
            </div>
            <div>
              <input type="email" placeholder="Your Email" class="form-input" required>
            </div>
          </div>
          <div>
            <input type="text" placeholder="Subject" class="form-input">
          </div>
          <div>
            <textarea rows="5" placeholder="Your Message" class="form-input" required></textarea>
          </div>
          <button type="submit" class="w-full bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white font-bold py-3 px-6 rounded-lg transition shadow-md">
            Send Message <i class="fas fa-paper-plane ml-2"></i>
          </button>
        </form>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="pt-12 pb-6 px-6">
    <div class="container mx-auto text-center animate-fadeInUp">
      <div class="flex flex-col items-center mb-8">
        <h4 class="text-3xl font-bold text-yellow-400">DigiPet Portal</h4>
        <p class="mt-2">Bridging pet owners, veterinarians & government</p>
      </div>
      
      <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-sm text-gray-200 mb-8">
        <div>
          <h5 class="font-semibold mb-2">Quick Links</h5>
          <ul class="space-y-1">
            <li><a href="#hero" class="hover:underline">Home</a></li>
            <li><a href="#features" class="hover:underline">Features</a></li>
            <li><a href="#team" class="hover:underline">Team</a></li>
            <li><a href="#feedback" class="hover:underline">Feedback</a></li>
            <li><a href="#metrics" class="hover:underline">Metrics</a></li>
            <li><a href="#faq" class="hover:underline">FAQ</a></li>
          </ul>
        </div>
        <div>
          <h5 class="font-semibold mb-2">Contact</h5>
          <p>Email: support@digipet.portal</p>
          <p>Phone: +91-9876543210</p>
          <p>Goa, India</p>
        </div>
        <div>
          <h5 class="font-semibold mb-2">Legal</h5>
          <ul class="space-y-1">
            <li><a href="#" class="hover:underline">Privacy Policy</a></li>
            <li><a href="#" class="hover:underline">Terms of Service</a></li>
            <li><a href="#" class="hover:underline">Refund Policy</a></li>
          </ul>
        </div>
        <div>
          <h5 class="font-semibold mb-2">Follow Us</h5>
          <div class="flex justify-center gap-4 text-lg">
            <a href="#"><i class="fab fa-facebook fa-lg hover:text-yellow-400"></i></a>
            <a href="#"><i class="fab fa-twitter fa-lg hover:text-yellow-400"></i></a>
            <a href="#"><i class="fab fa-instagram fa-lg hover:text-yellow-400"></i></a>
          </div>
        </div>
      </div>
      
      <div class="border-t border-green-800 pt-6">
        <p class="text-xs text-gray-400">&copy; 2025 DigiPet Portal. All rights reserved.</p>
      </div>
    </div>
  </footer>

  <!-- Scroll to Top & Help Buttons -->
  <button id="scrollTop" class="scroll-btn hidden"><i class="fas fa-arrow-up"></i></button>
  <button id="helpBtn" class="help-btn" onclick="window.location.href='#faq'">
    <i class="fas fa-question-circle fa-lg"></i>
  </button>

  <!-- Scripts -->
  <script>
    // Mobile menu toggle
    const mobileMenuButton = document.getElementById('mobileMenuButton');
    const mobileMenu = document.getElementById('mobileMenu');
    mobileMenuButton.addEventListener('click', () => mobileMenu.classList.remove('hidden'));
    mobileMenu.querySelector('button').addEventListener('click', () => mobileMenu.classList.add('hidden'));

    // Scroll to top button
    const scrollTop = document.getElementById('scrollTop');
    window.addEventListener('scroll', () => {
      scrollTop.classList.toggle('hidden', window.scrollY < 400);
    });
    scrollTop.onclick = () => window.scrollTo({ top:0, behavior:'smooth' });

    // FAQ accordion animation
    document.querySelectorAll('details').forEach(detail => {
      detail.addEventListener('toggle', () => {
        const icon = detail.querySelector('i');
        if (detail.open) {
          icon.classList.add('rotate-180');
        } else {
          icon.classList.remove('rotate-180');
        }
      });
    });
  </script>
</body>
</html>