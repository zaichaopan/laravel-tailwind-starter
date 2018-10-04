<template>
    <nav class="flex items-center justify-between flex-wrap">
        <div class="nav-container">
            <!-- left -->
            <div class="left flex justify-between w-full lg:w-auto flex-1 lg:flex-initial">
                <ul class="list-reset flex items-center">
                    <li class="">
                        <a href="/home"
                           class="flex items-center h-16 text-grey-darker no-underline">Laravel
                        </a>
                    </li>
                </ul>

                <div class='flex items-center lg:hidden'
                     @click="toggleMobileNav">
                    <span class="hamburger-menu"
                          :class="{open: shouldShowMobileNav}">
                    </span>
                </div>
            </div>

            <!-- right -->
            <div class="right bg-white w-full lg:flex pt-0 lg:w-auto "
                 :class="{active: shouldShowMobileNav}">
                <ul class="list-reset flex flex-1 flex-col lg:flex-row">
                    <li class="py-0">
                        <a to='/home'
                           class="flex items-center h-16 capitalize text-sm font-light text-grey-darker underline no-underline">
                            Home
                        </a>
                    </li>
                    <li class="py-0">
                        <a href='#'
                           class="flex items-center h-16 capitalize text-sm font-light text-grey-darker underline no-underline">
                            <base-icon icon-name="message"
                                       :view-box-width="24"
                                       :view-box-height="24">
                                <icon-chat />
                            </base-icon>&nbsp;&nbsp;Messages
                        </a>
                    </li>

                    <li class="lg:py-0">
                        <a href='#'
                           class="flex items-center h-16 capitalize text-sm font-light text-grey-darker underline no-underline">
                            <base-icon icon-name="bell">
                                <icon-bell />
                            </base-icon>&nbsp;Notificationss
                        </a>
                    </li>

                    <li class="py-0">
                        <base-dropdown dropdown-class="w-full lg:w-48"
                                       alignment="r"
                                       :z-index="50">
                            <a slot="link"
                               href="#"
                               class="flex items-center h-16 text-sm font-light capitalize text-sm text-grey-darker underline no-underline">{{user.name}}
                                &nbsp;
                                <base-icon icon-name="caret"
                                           :width="12"
                                           :height="12">
                                    <icon-caret />
                                </base-icon>
                            </a>

                            <div slot="dropdown"
                                 class="bg-white border border-b-0 overflow-hidden">
                                <a href="#"
                                   class="no-underline block px-4 py-4 border-b text-sm text-grey-darker hover:bg-grey-lightest whitespace-no-wrap">Action</a>
                                <a href="#"
                                   class="flex items-center no-underline block text-sm px-1 py-4 border-b text-grey-darker hover:bg-grey-lightest whitespace-no-wrap">
                                    <span> Setting</span>
                                </a>
                                <a href="/logout"
                                   @click.prevent="logout"
                                   class="flex items-center no-underline text-sm block px-4 py-4 border-b text-grey-darker hover:bg-grey-lightest whitespace-no-wrap">
                                    <span>Logout</span>
                                </a>
                                <form ref="logoutForm"
                                      action="/logout"
                                      method="POST"
                                      class="hidden">
                                    <input type="hidden"
                                           name="_token"
                                           :value="csrfToken">
                                </form>
                            </div>
                        </base-dropdown>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

</template>

<script>
export default {
  data () {
    return {
      shouldShowMobileNav: false,
      user: window.App.user,
      csrfToken: window.App.csrfToken
    }
  },
  methods: {
    toggleMobileNav () {
      this.shouldShowMobileNav = !this.shouldShowMobileNav
    },
    closeMobileNav () {
      this.shouldShowMobileNav = false
    },
    logout () {
      this.$refs.logoutForm.submit()
    }
  },
  mounted () {
  }
}
</script>

<style lang="scss" scoped>
</style>
