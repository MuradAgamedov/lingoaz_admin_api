      <!-- Start Sidebar -->
      <aside id="app-menu" class="app-menu">

          <!-- Logo -->
          <a href="{{ route('home') }}" class="logo-box sticky top-0 flex min-h-topbar-height items-center justify-start px-6 backdrop-blur-xs">
              <span style="font-size:1.4rem; font-weight:800; letter-spacing:-0.5px; color: var(--color-default-900);">
                  Lingo<span style="color: var(--color-primary);">AZ</span>
              </span>
          </a>

          <!-- Toggle Button -->
          <div class="absolute top-0 end-5 flex h-topbar items-center justify">
              <button id="button-hover-toggle">
                  <i class="iconify tabler--circle size-5"></i>
              </button>
          </div>

          <!-- Menu -->
          <div class="relative flex flex-col flex-1 min-h-0" style="height: calc(100vh - var(--topbar-height, 60px));">
              <div class="size-full overflow-y-auto" data-simplebar>
                  <ul class="side-nav p-3 hs-accordion-group">

                      <li class="menu-title"><span>Lüğət</span></li>

                      <li class="menu-item">
                          <a href="{{ route('dictionary.index') }}" class="menu-link">
                              <span class="menu-icon"><i data-lucide="book-open"></i></span>
                              <span class="menu-text">Lüğət</span>
                          </a>
                      </li>

                      <li class="menu-item">
                          <a href="{{ route('dictionary-category.index') }}" class="menu-link">
                              <span class="menu-icon"><i data-lucide="layout-grid"></i></span>
                              <span class="menu-text">Lüğət Kateqoriyası</span>
                          </a>
                      </li>

                      <li class="menu-item">
                          <a href="{{ route('word-of-day.index') }}" class="menu-link">
                              <span class="menu-icon"><i data-lucide="sun"></i></span>
                              <span class="menu-text">Günün Sözü</span>
                          </a>
                      </li>

                      <li class="menu-title" style="margin-top:8px;"><span>İstifadəçilər</span></li>

                      <li class="menu-item">
                          <a href="{{ route('users.index') }}" class="menu-link">
                              <span class="menu-icon"><i data-lucide="users"></i></span>
                              <span class="menu-text">İstifadəçilər</span>
                          </a>
                      </li>

                      <li class="menu-item">
                          <a href="{{ route('subscribers.index') }}" class="menu-link">
                              <span class="menu-icon"><i data-lucide="mail"></i></span>
                              <span class="menu-text">Abunəçilər</span>
                          </a>
                      </li>

                      <li class="menu-title" style="margin-top:8px;"><span>Tətbiq</span></li>

                      <li class="menu-item">
                          <a href="{{ route('apk.index') }}" class="menu-link">
                              <span class="menu-icon"><i data-lucide="smartphone"></i></span>
                              <span class="menu-text">APK Buraxılışları</span>
                          </a>
                      </li>

                  </ul>
              </div>

              <!-- Sidebar Footer -->
              <div class="px-4 py-4 border-t border-default-200">
                  <div class="flex items-center gap-3">
                      <div class="flex items-center justify-center size-8 rounded-full bg-primary/10 flex-shrink-0">
                          <i data-lucide="user" class="size-4 text-primary"></i>
                      </div>
                      <div class="min-w-0 flex-1">
                          <p class="text-sm font-semibold text-default-800 truncate">{{ auth()->user()->name ?? auth()->user()->email }}</p>
                          <p class="text-xs text-default-400">Administrator</p>
                      </div>
                      <a href="{{ route('logout') }}"
                         onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                         class="text-default-400 hover:text-danger transition-colors">
                          <i data-lucide="log-out" class="size-4"></i>
                      </a>
                      <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">@csrf</form>
                  </div>
              </div>
          </div>

      </aside>
      <!-- End Sidebar -->
