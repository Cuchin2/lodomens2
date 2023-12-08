
<footer class="bg-gris-80" aria-labelledby="footer-heading">
    <h2 id="footer-heading" class="sr-only">Footer</h2>
    <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:py-16 lg:px-8">

      <div class=" grid md:grid-cols-3 gap-8  xl:col-span-2 md:text-center" x-data="{ openItem: null }">
        <div class="col-12 md:col-4">
          <h3 @click="openItem === 1 ? openItem = null : openItem = 1" class="collapsible text-sm font-semibold text-gris-20 tracking-wider uppercase">
            Solutions
            <!-- :class="open ? 'fa-chevron-down' : 'fa-chevron-up'" -->
            <span class="float-right text-gris-20 hover:text-gris-40 md:hidden cursor-pointer">
              <svg :class="openItem === 1 ? 'hidden' : 'block'" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
              </svg>
              <svg :class="openItem === 1 ? 'block' : 'hidden'" x-cloak="mobile" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
              </svg>
            </span>

          </h3>
          <ul x-show="openItem === 1" x-collapse.duration.400ms role="list" class="content space-y-4 " >
            <li>
              <a target="_blank" href="https://codepen.io/jettaz" class="text-base text-gris-40 hover:text-gray-900">
                Marketing
              </a>
            </li>

            <li>
              <a target="_blank" href="https://codepen.io/jettaz" class="text-base text-gris-40 hover:text-gray-900">
                Analytics
              </a>
            </li>

            <li>
              <a target="_blank" href="https://codepen.io/jettaz" class="text-base text-gris-40 hover:text-gray-900">
                Commerce
              </a>
            </li>

            <li>
              <a target="_blank" href="https://codepen.io/jettaz" class="text-base text-gris-40 hover:text-gray-900">
                Insights
              </a>
            </li>
          </ul>
        </div>
        <div  class="col-12 md:col-4">
          <h3 @click="openItem === 2 ? openItem = null : openItem = 2" class="collapsible text-sm font-semibold text-gris-20 tracking-wider uppercase">
            Support
            <span class="float-right text-gris-20 hover:text-gris-40 md:hidden cursor-pointer">
              <svg :class="openItem === 2 ? 'hidden' : 'block'" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
              </svg>
              <svg :class="openItem === 2 ? 'block' : 'hidden'" x-cloak="mobile" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
              </svg>
            </span>
          </h3>
          <ul x-show="openItem === 2" x-collapse.duration.400ms role="list" class="content space-y-4" >
            <li>
              <a target="_blank" href="https://codepen.io/jettaz" class="text-base text-gris-40 hover:text-gray-900">
                Pricing
              </a>
            </li>

            <li>
              <a target="_blank" href="https://codepen.io/jettaz" class="text-base text-gris-40 hover:text-gray-900">
                Documentation
              </a>
            </li>

            <li>
              <a target="_blank" href="https://codepen.io/jettaz" class="text-base text-gris-40 hover:text-gray-900">
                Guides
              </a>
            </li>

            <li>
              <a target="_blank" href="https://codepen.io/jettaz" class="text-base text-gris-40 hover:text-gray-900">
                API Status
              </a>
            </li>
          </ul>
        </div>
        <div  class="col-12 md:col-4">
          <h3 @click="openItem === 3 ? openItem = null : openItem = 3" class="collapsible text-sm font-semibold text-gris-20 tracking-wider uppercase">
            Company
            <span class="float-right text-gris-20 hover:text-gris-40 md:hidden cursor-pointer">
              <svg :class="openItem === 3 ? 'hidden' : 'block'" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
              </svg>
              <svg :class="openItem === 3 ? 'block' : 'hidden'" x-cloak="mobile" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
              </svg>
            </span>
          </h3>
          <ul x-show="openItem === 3" x-collapse.duration.400ms role="list" class="content space-y-4 cola">
            <li>
              <a target="_blank" href="https://codepen.io/jettaz" class="text-base text-gris-40 hover:text-gray-900">
                About
              </a>
            </li>

            <li>
              <a target="_blank" href="https://codepen.io/jettaz" class="text-base text-gris-40 hover:text-gray-900">
                Blog
              </a>
            </li>

            <li>
              <a target="_blank" href="https://codepen.io/jettaz" class="text-base text-gris-40 hover:text-gray-900">
                Jobs
              </a>
            </li>

            <li>
              <a target="_blank" href="https://codepen.io/jettaz" class="text-base text-gris-40 hover:text-gray-900">
                Press
              </a>
            </li>

            <li>
              <a target="_blank" href="https://codepen.io/jettaz" class="text-base text-gris-40 hover:text-gray-900">
                Partners
              </a>
            </li>
          </ul>
        </div>

      </div>


    </div>
  </footer>

@push('scripts')
<style>

@media (min-width: 768px) {
  [x-show="openItem === 1"] {
    display: block !important; height: inherit!important;
  }
  [x-show="openItem === 2"] {
    display: block !important; height: inherit!important;
  }
  [x-show="openItem === 3"] {
    display: block !important; height: inherit!important;
  }

}
</style>
@endpush
