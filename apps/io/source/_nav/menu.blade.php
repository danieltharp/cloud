<nav class="hidden lg:flex items-center justify-end text-lg">
    <a title="{{ $page->siteName }} Posts" href="/all"
        class="ml-6 text-blue-600 hover:text-blue-800 {{ $page->isActive('/') ? 'active text-blue-800' : '' }}">
        Posts
    </a>

    <a title="{{ $page->siteName }} About" href="/about"
        class="ml-6 text-blue-600 hover:text-blue-800 {{ $page->isActive('/about') ? 'active text-blue-800' : '' }}">
        About
    </a>

    <a title="{{ $page->siteName }} Contact" href="/contact"
        class="ml-6 text-blue-600 hover:text-blue-800 {{ $page->isActive('/contact') ? 'active text-blue-800' : '' }}">
        Contact
    </a>
</nav>
