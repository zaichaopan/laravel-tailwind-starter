<div class="w-full my-8">
    <form action="" class="bg-white rounded-lg shadow inline-flex flex-col">
        <div class="flex px-4 pt-4 pb-2">
            <div class="form-radio">
                <input id="round-trip" name="trip" type="radio" checked>
                <label for="round-trip" class="radio-label">Round Trip</label>
            </div>

            <div class="form-radio">
                <input id="one-way" name="trip" type="radio">
                <label for="one-way" class="radio-label">One way</label>
            </div>
        </div>

        <div class="px-6">
            <input class="w-full font-medium text-sm p-2 bg-grey-lighter rounded focus:bg-white focus:border-grey-light border-transparent border"
                placeholder="Leaving from" type="text" name="from">
        </div>

        <div class="my-4 px-6">
            <input class="w-full font-medium text-sm p-2 bg-grey-lighter rounded focus:bg-white focus:border-grey-light border-transparent border"
                placeholder="Going to from" type="text" name="to">
        </div>


        <div class="flex px-4">
            <div class="px-2">
                <input class="font-medium text-sm p-2 bg-grey-lighter rounded focus:bg-white focus:border-grey-light border-transparent border"
                    placeholder="Depart" type="text" name="to">
            </div>

            <div class="px-2">
                <input class="font-medium text-sm p-2 bg-grey-lighter rounded focus:bg-white focus:border-grey-light border-transparent border"
                    placeholder="Return" type="text" name="to">
            </div>
        </div>

        <div class="flex my-4 px-4">
            <div class="px-2 relative w-full">
                <select class="block appearance-none w-full bg-grey-lighter border border-grey-lighter text-grey-darker py-2 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-grey text-sm"
                    id="grid-state">
                        <option>1 passenger</option>
                        <option selected>2 passengers</option>

                        </select>
                <div class="pointer-events-none absolute pin-y pin-r-10px flex items-center pr-2 text-grey-darker">
                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                </div>
            </div>

            <div class="px-2 relative w-full">
                <select class="block appearance-none w-full bg-grey-lighter border border-grey-lighter text-grey-darker py-2 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-grey text-sm"
                    id="grid-state">
                          <option>Enconomy class</option>
                          <option>Business class</option>
                        </select>
                <div class="pointer-events-none absolute pin-y pin-r-10px flex items-center px-2 text-grey-darker">
                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                </div>
            </div>
        </div>

        <div>
            <button class="w-full bg-grey-darkest uppercase px-4 py-3 text-white text-xs rounded-b-lg font-medium">search flights</button>
        </div>
    </form>
</div>
