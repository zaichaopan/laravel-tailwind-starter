<template>
  <div class="tabbed">
    <ul>
      <li>
        <a href="#section1">Section 1</a>
      </li>
      <li>
        <a href="#section2">Section 2</a>
      </li>
      <li>
        <a href="#section3">Section 3</a>
      </li>
      <li>
        <a href="#section4">Section 4</a>
      </li>
    </ul>
    <section id="section1">
      <h2>Section 1</h2>
      <p>
        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam euismod, tortor nec pharetra ultricies, ante erat imperdiet velit, nec laoreet enim lacus a velit.
        <a
          href="#"
        >Nam luctus</a>, enim in interdum condimentum, nisl diam iaculis lorem, vel volutpat mi leo sit amet lectus. Praesent non odio bibendum magna bibendum accumsan.
      </p>
    </section>
    <section id="section2">
      <h2>Section 2</h2>
      <p>Nullam at diam nec arcu suscipit auctor non a erat. Sed et magna semper, eleifend magna non, facilisis nisl. Proin et est et lorem dictum finibus ut nec turpis. Aenean nisi tortor, euismod a mauris a, mattis scelerisque tortor. Sed dolor risus, varius a nibh id, condimentum lacinia est. In lacinia cursus odio a aliquam. Curabitur tortor magna, laoreet ut rhoncus at, sodales consequat tellus.</p>
    </section>
    <section id="section3">
      <h2>Section 3</h2>
      <p>
        Phasellus ac tristique orci. Nulla maximus
        <a href="">justo nec dignissim consequat</a>. Sed vehicula diam sit amet mi efficitur vehicula in in nisl. Aliquam erat volutpat. Suspendisse lorem turpis, accumsan consequat consectetur gravida,
        <a
          href="#"
        >pellentesque ac ante</a>. Aliquam in commodo ligula, sit amet mollis neque. Vestibulum at facilisis massa.
      </p>
    </section>
    <section id="section4">
      <h2>Section 4</h2>
      <p>Nam luctus, enim in interdum condimentum, nisl diam iaculis lorem, vel volutpat mi leo sit amet lectus. Praesent non odio bibendum magna bibendum accumsan. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam euismod, tortor nec pharetra ultricies, ante erat imperdiet velit, nec laoreet enim lacus a velit.</p>
    </section>
  </div>
</template>
<script>
export default {
  data () {
    return {
      tabList: null,
      tabs: null,
      panels: null
    }
  },
  methods: {
    initTabNodes () {
      const tabbed = document.querySelector('.tabbed')
      this.tablist = tabbed.querySelector('ul')
      this.tabs = this.tablist.querySelectorAll('a')
      this.panels = tabbed.querySelectorAll('[id^="section"]')
      this.tablist.setAttribute('role', 'tablist')
    },
    initTabs () {
      ;[...this.tabs].forEach((tab, i) => {
        tab.setAttribute('role', 'tab')
        tab.setAttribute('id', 'tab' + (i + 1))
        tab.setAttribute('tabindex', '-1')
        tab.parentNode.setAttribute('role', 'presentation')
        tab.addEventListener('click', e => {
          e.preventDefault()
          let currentTab = this.tablist.querySelector('[aria-selected]')
          if (e.currentTarget !== currentTab) {
            this.switchTab(currentTab, e.currentTarget)
          }
        })
        tab.addEventListener('keydown', e => {
          let index = Array.prototype.indexOf.call(this.tabs, e.currentTarget)
          let dir = e.which === 37
            ? index - 1
            : e.which === 39
              ? index + 1
              : e.which === 40
                ? 'down'
                : null

          if (dir !== null) {
            e.preventDefault()
            dir === 'down'
              ? this.panels[i].focus()
              : this.tabs[dir]
                ? this.switchTab(e.currentTarget, this.tabs[dir])
                : void 0
          }
        })
      })
    },
    initPanels () {
      ;[...this.panels].forEach((panel, i) => {
        panel.setAttribute('role', 'tabpanel')
        panel.setAttribute('tabindex', '-1')
        panel.setAttribute('aria-labelledby', this.tabs[i].id)
        panel.hidden = true
      })

      this.tabs[0].removeAttribute('tabindex')
      this.tabs[0].setAttribute('aria-selected', 'true')
      this.panels[0].hidden = false
    },
    switchTab (oldTab, newTab) {
      newTab.focus()
      newTab.removeAttribute('tabindex')
      newTab.setAttribute('aria-selected', 'true')
      oldTab.removeAttribute('aria-selected')
      oldTab.setAttribute('tabindex', '-1')
      let index = Array.prototype.indexOf.call(this.tabs, newTab)
      let oldIndex = Array.prototype.indexOf.call(this.tabs, oldTab)
      this.panels[oldIndex].hidden = true
      this.panels[index].hidden = false
    }
  },
  mounted () {
    this.initTabNodes()
    this.initTabs()
    this.initPanels()
  }
}
</script>
<style scoped>
[role="tablist"] {
  padding: 0;
}

[role="tablist"] li,
[role="tablist"] a {
  display: inline-block;
  color: grey;
}

[role="tablist"] li:focus {
  outline: none;
}

[role="tablist"] a:focus {
  outline: none;
}

[role="tablist"] a {
  text-decoration: none;
  padding: 0.5rem 1em;
}

[role="tablist"] [aria-selected] {
  background: #fff;
  border-bottom: 0;
  position: relative;
  border-bottom: 2px solid #222;
  color: #222;
}

[role="tabpanel"] {
  padding: 1.5rem 0;
  outline: none;
}

[role="tabpanel"] * + * {
  margin-top: 0.75rem;
}

@media (max-width: 550px) {
  [role="tablist"] li,
  [role="tablist"] a {
    display: block;
    position: static;
  }

  [role="tablist"] a {
    border: 1px solid #dee2e6 !important;
  }

  [role="tablist"] li + li a {
    border-top: 0 !important;
  }

  [role="tablist"] [aria-selected] {
    position: static;
  }

  [role="tablist"] [aria-selected]::after {
    content: "\0020⬅";
  }

  [role="tabpanel"] {
    border-top: 0;
  }
}
</style>
