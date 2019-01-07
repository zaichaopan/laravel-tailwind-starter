@extends('layouts.base')
@section('title', 'Welcome')
@section('content')
{{-- <div class="w-full">
    <div class="form-radio">
        <input id="radio-1" name="radio" type="radio" checked>
        <label for="radio-1" class="radio-label">Checked</label>
    </div>

    <div class="form-radio">
        <input id="radio-2" name="radio" type="radio">
        <label for="radio-2" class="radio-label">Unchecked</label>
    </div>

    <div class="form-radio">
        <input id="radio-3" name="radio" type="radio" disabled>
        <label for="radio-3" class="radio-label">Disabled</label>
    </div>

    <div class="form-checkbox">
        <input type="checkbox" class="checkbox" id="second" />
        <label for="second" class="checkbox-label">
          <span class="label-box"></span>
          <span class="label-text">Second Checkbox</span>
        </label>
    </div>

    <div class="form-switch">
        <input type="checkbox" class="switch" id="switch">
        <label for="switch">OK</label>

    </div>
</div>
<div class="w-full p-4">
    <div style="overflow-x:auto;">
        <table class="table-fixed rounded bg-white shadow-md" style="min-width:800px">
            <tr class="bg-grey-lighter uppercase text-xs text-grey-darker text-left border-b-2 border-grey-lighter">
                <th class="p-4 pl-20 font-semibold">Name</th>
                <th class="p-4 font-semibold">Policy</th>
                <th class="p-4 font-semibold">Location</th>
                <th class="p-4 font-semibold">Status</th>
                <th class="p-4"></th>
            </tr>
            <tr class="text-xs text-grey-darkest border-b border-grey-lighter">
                <td class="p-4">
                    <div class="flex items-center">
                        <img src="https://loremflickr.com/g/320/320/paris,girl/all?random=1" alt="" class="w-10 h-10 rounded-full">
                        <div class="pl-3 flex flex-col">
                            <span class="font-medium">Molly Sanders</span>
                            <span class="text-xs text-grey-dark pt-2">VP of Sales</span>
                        </div>
                    </div>

                </td>
                <td class="p-4">
                    <div class="flex flex-col">
                        <span class="font-medium">$20,000</span>
                        <span class="text-grey-dark pt-2">All-inclusive Policy</span>
                    </div>
                </td>
                <td class="p-4 font-medium text-grey-darker">Denver, CO</td>
                <td class="p-4 font-semibold">
                    <span class="rounded-full px-3 py-1 bg-green-lightest font-bold">Approved </span>
                </td>
                <td class="p-4 text-grey-dark">&bull;&bull;&bull;</td>

            </tr>
            <tr class="text-xs text-grey-darkest border-b border-grey-lighter">
                <td class="p-4">
                    <div class="flex items-center">
                        <img src="https://loremflickr.com/g/320/320/paris,girl/all?random=2" alt="" class="w-10 h-10 rounded-full">
                        <div class="pl-3 flex flex-col">
                            <span class="font-medium">Michael Roberts</span>
                            <span class="text-grey-dark pt-2">Advisory Board</span>
                        </div>
                    </div>
                </td>
                <td class="p-4">
                    <div class="flex flex-col">
                        <span class="font-medium">$5,000</span>
                        <span class="text-xs text-grey-dark pt-2">Basic Policy</span>
                    </div>
                </td>
                <td class="p-4 font-medium text-grey-darker">New York, NY</td>
                <td class="p-4 font-bold">
                    <span class="rounded-full px-3 py-2 bg-green-lightest">Approved </span>
                </td>
                <td class="p-4 text-grey-dark">&bull;&bull;&bull;</td>
            </tr>
            <tr class="text-xs text-grey-darkest border-b border-grey-lighter">
                <td class="p-4">
                    <div class="flex items-center">
                        <img src="https://loremflickr.com/g/320/320/paris,girl/all?random=3" alt="" class="w-10 h-10 rounded-full">
                        <div class="pl-3 flex flex-col">
                            <span class="font-medium">Devin Chils</span>
                            <span class="text-xs text-grey-dark pt-2">Marketing Manager</span>
                        </div>
                    </div>
                </td>
                <td class="p-4">
                    <div class="flex flex-col">
                        <span class="font-medium">$5,000</span>
                        <span class="text-grey-dark pt-2">Basic Policy</span>
                    </div>
                </td>
                <td class="p-4 font-medium text-grey-darker">Chicago, IL</td>
                <td class="p-4 font-semibold">
                    <span class="rounded-full px-3 py-2 bg-yellow-lighter text-xs font-bold">Awaiting approval </span>
                </td>
                <td class="p-4 text-grey-dark">&bull;&bull;&bull;</td>
            </tr>
        </table>
    </div>

</div>

<div class="w-full p-4">
    <div class="flex justify-between items-baseline pb-3 border-b-2 border-grey-light">
        <h1 class="text-lg text-grey-darkest font-normal">Change your plan</h1>

        <span class="text-grey-dark font-medium text-sm">Cancel your plan</span>
    </div>


    <div class="radio-box flex py-2 mt-4">
        <div class="mr-3">
            <input checked class="w-32 h-32" type="radio" name="radio5" id="radio3" value="1">
            <label for="radio3" class="w-32 h-32 text-grey-darkest">
                <div class="p-2">
                    <div class="uppercase text-xs font-semibold text-grey-darker">hobby</div>

                    <div class="mt-4">
                        <span class="text-xl font-bold">1</span>
                        <span class="uppercase text-sm font-bold">gb</span>
                    </div>

                    <div>
                        <span class="text-xs text-grey-darker">$</span><span class="font-bold text-sm">5</span>
                        <span class="font-semibold text-xs text-grey-dark"> / mo</span>
                    </div>
                </div>
            </label>
        </div>
        <div class="mr-3">
            <input class="w-32 h-32" type="radio" name="radio5" id="radio4" value="2">
            <label class="w-32 h-32 text-grey-darkest" for="radio4">
                <div class="px-2">
                    <div class="uppercase text-xs font-semibold text-grey-darker">growth</div>

                    <div class="mt-4">
                        <span class="text-xl font-bold">5</span>
                        <span class="uppercase text-sm font-bold">gb</span>
                    </div>

                    <div>
                        <span class="text-xs text-grey-darker">$</span><span class="font-bold text-sm">10</span>
                        <span class="font-semibold text-xs text-grey-dark"> / mo</span>
                    </div>
                </div>
            </label>
        </div>
        <div class="mr-3">
            <input class="w-32 h-32" type="radio" name="radio5" id="radio5" value="3">
            <label class="w-32 h-32" for="radio5">
                <div class="px-2">
                    <div class="uppercase text-xs font-semibold text-grey-darker">Business</div>

                    <div class="mt-4">
                        <span class="text-xl font-bold">10</span>
                        <span class="uppercase text-sm font-bold">gb</span>
                    </div>

                    <div>
                        <span class="text-xs text-grey-darker">$</span><span class="font-bold text-sm">15</span>
                        <span class="font-semibold text-xs text-grey-dark"> / mo</span>
                    </div>
                </div>
            </label>
        </div>
        <div class="mr-3">
            <input class="w-32 h-32" type="radio" name="radio5" id="radio6" value="6">
            <label class="w-32 h-32" for="radio6">
                <div class="px-2">
                    <div class="uppercase text-xs font-semibold text-grey-darker">enterprise</div>

                    <div class="mt-4">
                        <span class="text-xl font-bold">20</span>
                        <span class="uppercase text-sm font-bold">gb</span>
                    </div>

                    <div>
                        <span class="text-xs text-grey-darker">$</span><span class="font-bold text-sm">20</span>
                        <span class="font-semibold text-xs text-grey-dark"> / mo</span>
                    </div>
                </div>
            </label>
        </div>
    </div>
</div>

<div class="w-full mt-4  ml-4 mb-4">
    <div class="w-full flex flex-col justify-center items-center bg-white" style="height:360px; background-image: url(svg/locations.svg); background-color: white; background-repeat: no-repeat;background-position: center;">
        <div class="text-2xl text-grey-darkest">Join our newsletter</div>
        <div class="p-4 text-grey-dark font-thin">
            Sign up for our newsletter to get new reviews each week.
        </div>

        <form action=" " class="pt-6">
            <div class="border rounded-lg border-grey-light pl-2 bg-white h-10 flex">
                <input class="text-sm text-grey-darker w-64" type="email" placeholder="Enter your email" required>
                <button class="px-4 py-2 uppercase text-xs font-medium bg-blue text-white rounded-r-lg -m-px" type="submit">sign up</button>
            </div>
        </form>
    </div>
</div>

<div class="w-full mb-8 p-4">
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
</div> --}}
@endsection
