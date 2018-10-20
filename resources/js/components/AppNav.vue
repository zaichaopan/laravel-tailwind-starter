<template>
    <nav>
        <div class="nav-container">
            <!-- left -->
            <div class="navbar-left">
                <ul class="flex items-center">
                    <li>
                        <a href="/home" class="navbar-brand">Laravel</a>
                    </li>
                </ul>
                <button
                    class="navbar-toggle"
                    @click="toggleMobileNav"
                    type="button"
                    aria-label="Toggle navigation"
                >
                    <span class="navbar-toggle-icon" :class="{open: shouldShowMobileNav}"></span>
                </button>
            </div>
            <!-- right -->
            <div class="navbar-right" :class="{active: shouldShowMobileNav}">
                <ul>
                    <li>
                        <a to="/home" class="nav-link">Home</a>
                    </li>
                    <li>
                        <a href="#" class="nav-link">
                            <base-icon
                                icon-name="message"
                                :view-box-width="24"
                                :view-box-height="24"
                            >
                                <icon-chat/>
                            </base-icon>&nbsp;&nbsp;Messages
                        </a>
                    </li>
                    <li>
                        <a href="#" class="nav-link">
                            <base-icon icon-name="bell">
                                <icon-bell/>
                            </base-icon>&nbsp;Notificationss
                        </a>
                    </li>
                    <li>
                        <base-dropdown dropdown-class="w-full lg:w-48" alignment="r" :z-index="50">
                            <a slot="link" href="#" class="nav-dropdown-toggle">
                                {{user.name}}
                                &nbsp;
                                <base-icon icon-name="caret" :width="12" :height="12">
                                    <icon-caret/>
                                </base-icon>
                            </a>
                            <div slot="dropdown" class="nav-dropodwn-collapse">
                                <a href="#" class="nav-dropdown-link">Action</a>
                                <a href="#" class="nav-dropdown-link">
                                    <span>Setting</span>
                                </a>
                                <a href="/logout" @click.prevent="logout" class="nav-dropdown-link">
                                    <span>Logout</span>
                                </a>
                                <form ref="logoutForm" action="/logout" method="POST" name="logout">
                                    <csrf-token/>
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
      user: window.App.user
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
      document.forms.logout.submit()
    }
  },
  mounted () {
  }
}
</script>

<style lang="postcss" scoped>
nav {
  @apply border-0 flex flex-wrap justify-between items-center;
}

.nav-container {
  @apply w-full flex flex-col mx-auto items-center justify-between;
}

nav ul {
  @apply list-reset;
}

.navbar-left {
  @apply w-full flex flex-1 justify-between border-b border-grey-light px-4;
}

.navbar-brand {
  @apply flex items-center h-16 text-grey-darker no-underline;
}

.navbar-right {
  @apply hidden pt-0 bg-white w-full;
}

.navbar-right.active {
  @apply block;
}

.navbar-right ul {
  @apply flex flex-1 flex-col;
}

.navbar-right ul > li {
  @apply border-b border-grey-light;
}

.navbar-right ul > li a {
  @apply px-4;
}

.nav-link {
  @apply flex items-center h-16 capitalize text-sm font-light text-grey-darker underline no-underline;
}

.nav-dropdown-toggle {
  @apply flex items-center h-16 text-sm font-light capitalize text-sm text-grey-darker underline no-underline;
}

.nav-dropodwn-collapse {
  @apply bg-white border border-b-0 overflow-hidden;
}

.nav-dropdown-link {
  @apply flex items-center no-underline text-sm block px-4 py-4 border-b text-grey-darker whitespace-no-wrap;
}
.nav-dropdown-link:hover {
  @apply bg-grey-lightest;
}

.navbar-toggle {
  @apply flex items-center outline-none;
}

.navbar-toggle-icon {
  @apply w-4 bg-grey-darker inline-block relative;
  height: 0.15rem;
  transition: transform 0.2s ease-in-out;
}

.navbar-toggle-icon::before {
  content: "";
  @apply w-4 bg-grey-darker absolute;
  height: 0.15rem;
  bottom: 200%;
  left: -3%;
}

.navbar-toggle-icon::after {
  content: "";
  @apply w-4 bg-grey-darker absolute;
  height: 0.15rem;
  bottom: -200%;
  left: -3%;
}

.navbar-toggle-icon.open {
  transform: rotate(90deg);
  background: transparent;
}

.navbar-toggle-icon.open::before {
  bottom: 0%;
  transform: rotate(135deg);
}

.navbar-toggle-icon.open::after {
  bottom: 0%;
  transform: rotate(225deg);
}

@screen lg {
  nav {
    @apply border-b border-grey-light;
  }

  .nav-container {
    @apply flex-row;
    max-width: 992px;
  }

  .navbar-toggle {
    @apply hidden;
  }

  .navbar-left {
    @apply w-auto flex-initial border-0;
  }

  .navbar-right {
    @apply flex w-auto;
  }
  .navbar-right ul {
    @apply flex-row;
  }
  .navbar-right ul > li {
    @apply border-0;
  }
}

@screen xl {
  .nav-container {
    max-width: 1200px;
  }
}
</style>
