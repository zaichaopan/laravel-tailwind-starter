<template>
  <nav class="bg-white shadow">
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
            <a href="/home" class="nav-link">Home</a>
          </li>
          <li>
            <a href="#" class="nav-link">
              <!-- <base-icon icon-name="chat" view-box="24x24"/>&nbsp;&nbsp;Messages -->
              <svg
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 24 24"
                class="w-8 mr-4 icon-chat"
              >
                <path
                  class="primary"
                  d="M2 15V5c0-1.1.9-2 2-2h16a2 2 0 0 1 2 2v15a1 1 0 0 1-1.7.7L16.58 17H4a2 2 0 0 1-2-2z"
                ></path>
                <path
                  class="secondary"
                  d="M6 7h12a1 1 0 0 1 0 2H6a1 1 0 1 1 0-2zm0 4h8a1 1 0 0 1 0 2H6a1 1 0 0 1 0-2z"
                ></path>
              </svg>
            </a>
          </li>
          <li>
            <a href="#" class="nav-link">
              <!-- <base-icon icon-name="bell"/>&nbsp; -->
              <svg
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 24 24"
                class="w-8 mr-4 icon-notification"
              >
                <circle cx="12" cy="19" r="3" class="secondary"></circle>
                <path
                  class="primary"
                  d="M10.02 4.28L10 4a2 2 0 1 1 3.98.28A7 7 0 0 1 19 11v5a1 1 0 0 0 1 1 1 1 0 0 1 0 2H4a1 1 0 0 1 0-2 1 1 0 0 0 1-1v-5a7 7 0 0 1 5.02-6.72z"
                ></path>
              </svg>
            </a>
          </li>
          <li>
            <navbar-dropdown alignment="r">
              <span slot="dropdown-toggle">
                <img
                  src="https://loremflickr.com/320/240/paris,girl/all"
                  alt
                  class="w-10 h-10 rounded-full"
                >
              </span>
              <template slot="dropdown-menu">
                <a href="#" class="navbar-dropdown-item">
                  <span class="font-bold pb-2 text-grey-darkest">{{ user.name }}</span>
                  <span class="text-xs text-grey-dark">{{ user.email}}</span>
                </a>
                <div class="navbar-dropdown-item">
                  <span class="text-grey-darker">Notification preferences</span>
                  <span class="py-3 text-grey-darker">Profile & account</span>
                  <span class="text-grey-darker">Help & feedback</span>
                </div>
                <a href="/logout" @click.prevent="logout" class="navbar-dropdown-item">Sign out</a>
              </template>
            </navbar-dropdown>
            <form ref="logoutForm" action="/logout" method="POST" name="logout">
              <csrf-token/>
            </form>
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

nav ul {
  @apply list-reset;
}

.nav-container {
  @apply w-full flex flex-col mx-auto items-center justify-between;
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
