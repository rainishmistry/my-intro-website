@extends('layouts.public')

@section('content')

<!-- Hero Section -->
<section id="home" class="hero">
    <div class="profile-container">
        <img src="{{ isset($settings['profile_image_path']) ? asset($settings['profile_image_path']) : asset('images/profile_picture_1770985465852.png') }}" alt="Profile Picture" class="profile-img">
    </div>
    <h3>{{ $settings['hero_greeting'] ?? "Hi! I'm Rainish Mistry" }}</h3>
    <h1>{{ $settings['hero_headline'] ?? "Senior Web Developer based in New York." }}</h1>
    <p>{{ $settings['hero_description'] ?? "I am a backend-focused full-stack developer with 10+ years of experience building scalable applications with Laravel, Vue.js, and modern cloud technologies." }}</p>
    
    <div class="hero-btns">
        <button class="btn-contact" onclick="document.getElementById('contact').scrollIntoView({behavior: 'smooth'})">Contact Me</button>
        <a href="{{ isset($settings['resume_path']) ? asset($settings['resume_path']) : '#' }}" class="btn-outline" {{ isset($settings['resume_path']) ? 'target="_blank"' : '' }}>My Resume</a>
    </div>
</section>

<!-- About Section -->
<section id="about" class="section">
    <div class="section-title">
        <h2>{{ $settings['about_title'] ?? 'About Me' }}</h2>
        <p>Experienced developer with a passion for clean code and architecture.</p>
    </div>
    <div class="about-content">
        <div class="about-img">
            <!-- Using profile again or a different shot if available -->
            <!-- Using dynamic profile image -->
             <img src="{{ isset($settings['about_image_path']) ? asset($settings['about_image_path']) : asset('images/profile_picture_1770985465852.png') }}" alt="About Image" style="width:100%; height:auto; object-fit:cover;">
        </div>
        <div class="about-text">
            <h3>I craft high-performance web solutions.</h3>
            <p>{{ $settings['about_content'] ?? 'With over a decade of hands-on experience, I specialized in PHP/Laravel ecosystems, API development, and frontend integration. I have led teams, architected complex systems, and delivered robust solutions for enterprise clients.' }}</p>
            
            <div class="stats-grid">
                <div class="stat-card">
                    <span class="stat-number">{{ $settings['about_experience_years'] ?? '6+' }}</span>
                    <span>Years Exp.</span>
                </div>
                <div class="stat-card">
                    <span class="stat-number">{{ $settings['about_projects_completed'] ?? '5+' }}</span>
                    <span>Projects</span>
                </div>
                <div class="stat-card">
                    <span class="stat-number">{{ $settings['about_clients_satisfied'] ?? '3+' }}</span>
                    <span>Clients</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Services Section -->
<section id="services" class="section">
    <div class="section-title">
        <h2>Services</h2>
        <p>Specialized technical services tailored to your needs.</p>
    </div>
    <div class="services-grid">
        <div class="service-card">
            <div class="service-icon">💻</div>
            <h3>Backend Development</h3>
            <p>Robust API design, database architecture, and server-side logic using Laravel and PHP 8+.</p>
        </div>
        <div class="service-card">
            <div class="service-icon">🎨</div>
            <h3>Frontend Integration</h3>
            <p>Seamless integration of modern frontends (Vue, React, Blade) with backend systems.</p>
        </div>
        <div class="service-card">
            <div class="service-icon">🚀</div>
            <h3>Performance Optimization</h3>
            <p>Auditing and improving application speed, scalability, and security.</p>
        </div>
    </div>
</section>

<!-- Portfolio Section -->
<section id="portfolio" class="section">
    <div class="section-title">
        <h2>My Latest Work</h2>
        <p>A selection of recent projects showcasing technical and design skills.</p>
    </div>
    <div class="portfolio-grid">
        @foreach($projects as $project)
        <div class="portfolio-card">
            <div class="portfolio-img">
                <img src="{{ asset($project->image_path) }}" alt="{{ $project->title }}">
            </div>
            <div class="portfolio-content">
                <span class="portfolio-cat">{{ $project->category }}</span>
                <h3 class="portfolio-title">{{ $project->title }}</h3>
                <a href="{{ $project->link ?? '#' }}" class="btn-link">View Project →</a>
            </div>
        </div>
        @endforeach
    </div>
</section>

<!-- Contact Section -->
<section id="contact" class="section">
    <div class="section-title">
        <h2>Get In Touch</h2>
        <p>Lets discuss your next project.</p>
    </div>
    <div class="contact-container">
        <div class="contact-info">
            <h3>Contact Information</h3>
            <p>Feel free to reach out via email or social media.</p>
            <ul style="margin-top: 20px; list-style: none;">
                <li style="margin-bottom: 10px;">📧 {{ $settings['contact_email'] ?? 'rainish.developer@gmail.com' }}</li>
                <li style="margin-bottom: 10px;">📍 {{ $settings['contact_address'] ?? 'Surat, Gujarat, India' }}</li>
                <li>📱 {{ $settings['contact_phone'] ?? '+91 7567910005' }}</li>
            </ul>
        </div>
        <div class="contact-form">
            @if(session('success'))
                <div style="background: #d4edda; color: #155724; padding: 15px; border-radius: 5px; margin-bottom: 20px;">
                    {{ session('success') }}
                </div>
            @endif
            
            <form action="{{ route('contact.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <input type="text" name="name" class="form-control" placeholder="Your Name" required>
                </div>
                <div class="form-group">
                    <input type="email" name="email" class="form-control" placeholder="Your Email" required>
                </div>
                <div class="form-group">
                    <textarea name="message" class="form-control" placeholder="Your Message" required></textarea>
                </div>
                <button type="submit" class="btn-contact">Send Message</button>
            </form>
        </div>
    </div>
</section>

@endsection
