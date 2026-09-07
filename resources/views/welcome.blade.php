<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Tùng — Full-stack Laravel Developer</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,400;9..144,500;9..144,600&family=Inter:wght@400;500;600&family=IBM+Plex+Mono:wght@400;500&display=swap" rel="stylesheet">
<script src="https://cdn.tailwindcss.com"></script>
<script>
  tailwind.config = {
    theme: {
      extend: {
        colors: {
          paper: '#EFEDE6',
          ink: '#1C1E22',
          pine: '#2F5233',
          rust: '#B5482D',
          line: '#C9C4B7',
        },
        fontFamily: {
          serif: ['Fraunces', 'serif'],
          sans: ['Inter', 'sans-serif'],
          mono: ['IBM Plex Mono', 'monospace'],
        },
      },
    },
  }
</script>
<style>
  html { scroll-behavior: smooth; }
  ::selection { background: #2F5233; color: #EFEDE6; }
  .underline-grow { background-image: linear-gradient(#B5482D, #B5482D); background-size: 0% 1px; background-repeat: no-repeat; background-position: left bottom; transition: background-size .3s ease; }
  .underline-grow:hover { background-size: 100% 1px; }
  @media (prefers-reduced-motion: reduce) {
    html { scroll-behavior: auto; }
    .underline-grow { transition: none; }
  }
</style>
</head>
<body class="bg-paper text-ink font-sans antialiased">

  <!-- Header -->
  <header class="max-w-5xl mx-auto px-6 md:px-10 pt-8 pb-6 flex items-center justify-between border-b border-line">
    <a href="#" class="font-serif text-lg tracking-tight">Tùng</a>
    <nav class="flex gap-6 text-sm">
      <a href="#work" class="underline-grow pb-0.5">Dự án</a>
      <a href="#about" class="underline-grow pb-0.5">Giới thiệu</a>
      <a href="#contact" class="underline-grow pb-0.5">Liên hệ</a>
    </nav>
  </header>

  <!-- Hero -->
  <section class="max-w-5xl mx-auto px-6 md:px-10 py-16 md:py-24 grid md:grid-cols-5 gap-10 items-start">
    <div class="md:col-span-3">
      <h1 class="font-serif text-4xl md:text-5xl leading-[1.15] font-medium">
        Xây dựng sản phẩm web chắc chắn, dễ bảo trì, chạy đúng như kỳ vọng.
      </h1>
      <p class="mt-6 text-base md:text-lg text-ink/70 max-w-md leading-relaxed">
        Mình là lập trình viên full-stack, tập trung vào Laravel — từ hạ tầng server, kiến trúc backend, đến giao diện Blade hoàn chỉnh.
      </p>
      <div class="mt-8 flex items-center gap-6">
        <a href="#work" class="inline-flex items-center px-5 py-2.5 bg-pine text-paper text-sm font-medium hover:bg-pine/90 transition-colors">
          Xem dự án
        </a>
        <a href="#contact" class="text-sm underline-grow pb-0.5">Liên hệ trực tiếp</a>
      </div>
    </div>

    <div class="md:col-span-2 border border-line p-6 text-sm">
      <dl class="space-y-4">
        <div class="flex justify-between border-b border-line pb-3">
          <dt class="text-ink/50">Vai trò</dt>
          <dd class="font-medium text-right">Full-stack Developer</dd>
        </div>
        <div class="flex justify-between border-b border-line pb-3">
          <dt class="text-ink/50">Công nghệ chính</dt>
          <dd class="font-mono text-right text-[13px]">Laravel · Blade · MySQL</dd>
        </div>
        <div class="flex justify-between border-b border-line pb-3">
          <dt class="text-ink/50">Khu vực</dt>
          <dd class="font-medium text-right">Hà Nội, Việt Nam</dd>
        </div>
        <div class="flex justify-between">
          <dt class="text-ink/50">Trạng thái</dt>
          <dd class="font-medium text-right text-pine">Đang nhận dự án mới</dd>
        </div>
      </dl>
    </div>
  </section>

  <!-- Work -->
  <section id="work" class="max-w-5xl mx-auto px-6 md:px-10 py-16 md:py-20 border-t border-line">
    <h2 class="font-serif text-2xl md:text-3xl mb-10">Dự án đã thực hiện</h2>

    <div class="divide-y divide-line border-t border-b border-line">

      <article class="group py-8 grid md:grid-cols-5 gap-4 md:gap-8 hover:pl-3 transition-[padding] duration-200">
        <div class="md:col-span-1">
          <span class="font-mono text-xs text-ink/50">2025</span>
        </div>
        <div class="md:col-span-3">
          <h3 class="font-serif text-xl mb-2">Hệ thống CMS nội bộ đa site</h3>
          <p class="text-ink/70 text-sm leading-relaxed">
            Xây dựng và duy trì bộ package lõi cho CMS nội bộ, hỗ trợ vận hành nhiều website sản phẩm và khách hàng trên cùng một nền tảng.
          </p>
        </div>
        <div class="md:col-span-1 flex md:justify-end items-start gap-2 flex-wrap">
          <span class="font-mono text-[11px] border border-line px-2 py-1 h-fit">Laravel</span>
          <span class="font-mono text-[11px] border border-line px-2 py-1 h-fit">Composer</span>
        </div>
      </article>

      <article class="group py-8 grid md:grid-cols-5 gap-4 md:gap-8 hover:pl-3 transition-[padding] duration-200">
        <div class="md:col-span-1">
          <span class="font-mono text-xs text-ink/50">2024</span>
        </div>
        <div class="md:col-span-3">
          <h3 class="font-serif text-xl mb-2">Website sản phẩm cho khách hàng</h3>
          <p class="text-ink/70 text-sm leading-relaxed">
            Triển khai giao diện và tối ưu hiệu năng tải trang cho website chạy trên nền tảng CMS, từ template Blade đến tối ưu tài nguyên tĩnh.
          </p>
        </div>
        <div class="md:col-span-1 flex md:justify-end items-start gap-2 flex-wrap">
          <span class="font-mono text-[11px] border border-line px-2 py-1 h-fit">Blade</span>
          <span class="font-mono text-[11px] border border-line px-2 py-1 h-fit">Tailwind</span>
        </div>
      </article>

      <article class="group py-8 grid md:grid-cols-5 gap-4 md:gap-8 hover:pl-3 transition-[padding] duration-200">
        <div class="md:col-span-1">
          <span class="font-mono text-xs text-ink/50">2023</span>
        </div>
        <div class="md:col-span-3">
          <h3 class="font-serif text-xl mb-2">Hạ tầng triển khai & container hoá</h3>
          <p class="text-ink/70 text-sm leading-relaxed">
            Thiết lập môi trường server, đóng gói ứng dụng bằng container, xây quy trình deploy ổn định cho các dự án Laravel.
          </p>
        </div>
        <div class="md:col-span-1 flex md:justify-end items-start gap-2 flex-wrap">
          <span class="font-mono text-[11px] border border-line px-2 py-1 h-fit">Docker</span>
          <span class="font-mono text-[11px] border border-line px-2 py-1 h-fit">Nginx</span>
        </div>
      </article>

    </div>
  </section>

  <!-- About -->
  <section id="about" class="max-w-5xl mx-auto px-6 md:px-10 py-16 md:py-20 border-t border-line grid md:grid-cols-5 gap-10">
    <div class="md:col-span-3">
      <h2 class="font-serif text-2xl md:text-3xl mb-6">Giới thiệu</h2>
      <p class="text-ink/70 leading-relaxed max-w-md">
        Mình làm việc trong hệ sinh thái Laravel đã nhiều năm — từ việc xây dựng package nội bộ, thiết kế giao diện Blade, cho đến vận hành hạ tầng server. Mình thích những giải pháp gọn, dễ bảo trì, và chỉ thay đổi đúng phần cần thay đổi thay vì viết lại toàn bộ.
      </p>
    </div>
    <div class="md:col-span-2 grid grid-cols-2 gap-x-6 gap-y-4 text-sm">
      <div>
        <p class="text-ink/50 mb-2">Backend</p>
        <ul class="space-y-1 text-ink/80">
          <li>Laravel</li>
          <li>MySQL</li>
          <li>REST API</li>
        </ul>
      </div>
      <div>
        <p class="text-ink/50 mb-2">Frontend</p>
        <ul class="space-y-1 text-ink/80">
          <li>Blade</li>
          <li>Tailwind CSS</li>
          <li>Alpine.js</li>
        </ul>
      </div>
      <div>
        <p class="text-ink/50 mb-2">Hạ tầng</p>
        <ul class="space-y-1 text-ink/80">
          <li>Docker</li>
          <li>Nginx</li>
          <li>CI/CD</li>
        </ul>
      </div>
      <div>
        <p class="text-ink/50 mb-2">Khác</p>
        <ul class="space-y-1 text-ink/80">
          <li>Botble CMS</li>
          <li>Git</li>
        </ul>
      </div>
    </div>
  </section>

  <!-- Contact -->
  <section id="contact" class="max-w-5xl mx-auto px-6 md:px-10 py-16 md:py-24 border-t border-line text-center">
    <h2 class="font-serif text-2xl md:text-3xl mb-4">Cùng trao đổi về dự án của bạn</h2>
    <p class="text-ink/70 mb-6">Gửi email, mình sẽ phản hồi trong vòng 1–2 ngày làm việc.</p>
    <a href="mailto:hello@example.com" class="font-mono text-lg text-pine underline-grow pb-1">hello@example.com</a>
  </section>

  <!-- Footer -->
  <footer class="max-w-5xl mx-auto px-6 md:px-10 py-8 border-t border-line flex items-center justify-between text-xs text-ink/50">
    <span>© 2026 Tùng</span>
    <span>Hà Nội, Việt Nam</span>
  </footer>

</body>
</html>