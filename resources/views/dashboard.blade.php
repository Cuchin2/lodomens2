<x-app-layout>
    <x-slot name="slot1">
        <x-breadcrumb.breadcrumb />
    </x-slot>


    <x-slot name="slot2">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg ">
       {{--   <x-welcome />  --}}
     {{--     <div class="wrapper" x-data="{
            search: '',
            show_item(el) {
              return this.search === '' || el.textContent.includes(this.search)
            }
          }">

            <input class="search-input" type="search" placeholder="Filter: A B C D" x-model="search">

            <div>
              <p>Search Input: <span x-text="search"></span></p>
            </div>

            <p><b>Menu:</b></p>
            <ul class="menu">
              <li x-show="show_item($el)">Item A</li>
              <li x-show="show_item($el)">Item B</li>
              <li x-show="show_item($el)">
                Dropdown C
                <ul>
                  <li x-show="show_item($el)">Item C:A</li>
                  <li x-show="show_item($el)">Item C:B</li>
                </ul>
              </li>
              <li x-show="show_item($el)">Item D</li>
              <li x-show="show_item($el)">Item E</li>
              <li x-show="show_item($el)">Item F</li>
              <li x-show="show_item($el)">
                Dropdown G
                <ul>
                  <li x-show="show_item($el)">Item G:A</li>
                  <li x-show="show_item($el)">Item G:B</li>
                </ul>
              </li>
            </ul>
          </div>  --}}
        </div>
    </x-slot>
</x-app-layout>
