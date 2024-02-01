<div x-data="
        {
            rating: 0,
            hoverRating: 0,
            ratings: [{'amount': 1, 'label':'Malo'}, {'amount': 2, 'label':'Regular'}, {'amount': 3, 'label':'Bueno'}, {'amount': 4, 'label':'Estupendo'}, {'amount': 5, 'label':'Excelente'}],
            rate(amount) {
                if (this.rating == amount) {
            this.rating = 0;
          }
                else this.rating = amount;
            },
        currentLabel() {
           let r = this.rating;
          if (this.hoverRating != this.rating) r = this.hoverRating;
          let i = this.ratings.findIndex(e => e.amount == r);
          if (i >=0) {return this.ratings[i].label;} else {return ''};
        }
        }
        " class="flex items-center mb-1">
    <div class="flex ">
        <template x-for="(star, index) in ratings" :key="index">
            <button @click="rate(star.amount), $wire.rate(star.amount)" @mouseover="hoverRating = star.amount" @mouseleave="hoverRating = rating"
                aria-hidden="true" :title="star.label"
                class="rounded-sm text-gray-400 fill-current focus:outline-none focus:shadow-outline px-[2px] m-0 cursor-pointer"
                :class="{'text-gray-600': hoverRating >= star.amount, 'text-[#C69B4C]': rating >= star.amount && hoverRating >= star.amount}">
                <svg class="w-5 transition duration-150" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                    fill="currentColor">
                    <path
                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                </svg>
            </button>

        </template>
    </div>
    <div class="flex text-center justify-center">
        <template x-if="rating || hoverRating">
            <p x-text="currentLabel()"></p>
        </template>
        <template x-if="!rating && !hoverRating">
            <p>Calificanos!</p>
        </template>
    </div>
</div>
