<header class="page-head rd-navbar-wrap header_corporate">
    <nav class="rd-navbar" data-layout="rd-navbar-fixed" data-sm-layout="rd-navbar-fullwidth" data-md-layout="rd-navbar-fullwidth" data-lg-layout="rd-navbar-fullwidth" data-device-layout="rd-navbar-fixed" data-sm-device-layout="rd-navbar-fixed" data-md-device-layout="rd-navbar-fixed" data-lg-device-layout="rd-navbar-fullwidth" data-stick-up-offset="100px">

        @include('elements.top-nav')

        <div class="rd-navbar-inner inner-wrap">
            <div class="rd-navbar-panel">
                <button data-rd-navbar-toggle=".rd-navbar-nav-wrap" class="rd-navbar-toggle">
                    <span></span>
                </button>
                <div class="rd-navbar-brand">
                    <a href="{{route('welcome')}}" class="brand-name">
                        <img src="{{asset('theme/images/logo-1.png')}}" alt="{{config('app.name')}}">
                    </a>
                </div>
            </div>
            <div class="btn-group">
                <a href="submit-property.html" class="btn btn-sm btn-primary">Submit Property</a>
            </div>


          <div class="rd-navbar-nav-wrap">
            <!-- RD Navbar Nav-->
            <ul class="rd-navbar-nav">
                <li><a href="#">Chi Siamo</a></li>
                {{-- <li><a href="#">Dicono di noi</a></li>
                <li><a href="#">Perché Sceglieci</a></li> --}}

                <li>
                    <a href="#">Vendita</a>
                    <ul class="rd-navbar-dropdown">
                        <li>
                            <a href="property-catalog-grid.html">Property catalog grid</a>
                        </li>
                        <li>
                            <a href="property-catalog-list.html">Property catalog list</a>
                        </li>
                        <li>
                            <a href="single-property-page.html">Property catalog single</a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="#">Affitto</a>
                    <ul class="rd-navbar-dropdown">
                        <li>
                            <a href="property-catalog-grid.html">Property catalog grid</a>
                        </li>
                        <li>
                            <a href="property-catalog-list.html">Property catalog list</a>
                        </li>
                        <li>
                            <a href="single-property-page.html">Property catalog single</a>
                        </li>
                    </ul>
                </li>


                <li><a href="#">Contatti</a></li>
              {{-- <li class="active">
                <a href="./">Home</a>
              </li> --}}
              {{-- <li>
                <a href="#">Elements</a>
                <!-- RD Navbar Dropdown-->
                <ul class="rd-navbar-dropdown">
                  <li>
                    <a href="tabs-&amp;-accordions.html">Tabs &amp; Accordions</a>
                  </li>
                  <li>
                    <a href="typography.html">Typography</a>
                  </li>
                  <li>
                    <a href="forms.html">Forms</a>
                  </li>
                  <li>
                    <a href="buttons.html">Buttons</a>
                  </li>
                  <li>
                    <a href="grid-systems.html">Grid</a>
                  </li>
                  <li>
                    <a href="icons.html">Icons</a>
                  </li>
                  <li>
                    <a href="table-styles.html">Tables</a>
                  </li>
                  <li>
                    <a href="progress-bars.html">Progress bars</a>
                  </li>
                </ul>
              </li> --}}
              {{-- <li>
                <a href="#">Features</a>
                <!-- RD Navbar Dropdown-->
                <ul class="rd-navbar-dropdown">
                  <li>
                    <a href="footer-center-dark.html">Header Center, Footer Dark</a>
                  </li>
                  <li>
                    <a href="header-minimal.html">Header Minimal, Footer Dark</a>
                  </li>
                  <li>
                    <a href="header-corporate-default.html">Header Corporate Default</a>
                  </li>
                  <li>
                    <a href="header-hamburger.html">Header Hamburger Menu</a>
                  </li>
                  <li>
                    <a href="footer-center-dark.html">Footer Center Dark</a>
                  </li>
                  <li>
                    <a href="footer-light.html">Footer Light</a>
                  </li>
                  <li>
                    <a href="footer-widget.html">Footer Widget Light</a>
                  </li>
                  <li>
                    <a href="footer-widget-dark.html">Footer Widget Dark</a>
                  </li>
                </ul>
              </li> --}}
              {{-- <li>
                <a href="#">Extras</a>
                <!-- RD Navbar Dropdown-->
                <ul class="rd-navbar-dropdown">
                  <li>
                    <a href="404.html">404</a>
                  </li>
                  <li>
                    <a href="coming-soon.html">Coming soon</a>
                  </li>
                  <li>
                    <a href="login.html">Login page</a>
                  </li>
                  <li>
                    <a href="maintenance.html">Maintenance page</a>
                  </li>
                  <li>
                    <a href="terms-of-service.html">Terms of Use</a>
                  </li>
                </ul>
              </li> --}}

              {{-- <li>
                <a href="#">Pages</a>
                <!-- RD Navbar Megamenu-->
                <ul class="rd-navbar-megamenu">
                  <li>
                    <p>Pages 1</p>
                    <ul>
                      <li>
                        <a href="agency-page.html">Agency Page</a>
                      </li>
                      <li>
                        <a href="our-team.html">Our Team</a>
                      </li>
                      <li>
                        <a href="personal-page.html">Agent Personal Page</a>
                      </li>
                      <li>
                        <a href="contact-us.html">Contact Us</a>
                      </li>
                      <li>
                        <a href="pricing.html">Pricing</a>
                      </li>
                    </ul>
                  </li>
                  <li>
                    <p>Pages 2</p>
                    <ul>
                      <li>
                        <a href="categories.html">Categories</a>
                      </li>
                      <li>
                        <a href="clients.html">Client Page</a>
                      </li>
                      <li>
                        <a href="faq.html">FAQ Page</a>
                      </li>
                      <li>
                        <a href="services.html">Services</a>
                      </li>
                      <li>
                        <a href="services-2.html">Services 2</a>
                      </li>
                      <li>
                        <a href="submit-property.html">Submit Property</a>
                      </li>
                      <li>
                        <a href="make-an-appointment.html">Make an Appointment</a>
                      </li>
                    </ul>
                  </li>
                  <li>
                    <p>Blog</p>
                    <ul>
                      <li>
                        <a href="2-columns-blog.html">2 Columns Blog</a>
                      </li>
                      <li>
                        <a href="2-columns-blog-masonry.html">2 Columns Blog Masonry</a>
                      </li>
                      <li>
                        <a href="3-columns-grid-blog.html">3 Columns Blog</a>
                      </li>
                      <li>
                        <a href="3-columns-masonry-layout.html">3 Columns Blog Masonry</a>
                      </li>
                      <li>
                        <a href="left-sidebar.html">Blog Left Sidebar</a>
                      </li>
                      <li>
                        <a href="right-sidebar.html">Blog Right Sidebar</a>
                      </li>
                      <li>
                        <a href="post-page.html">Post Page</a>
                      </li>
                      <li>
                        <a href="timeline.html">Timeline</a>
                      </li>
                    </ul>
                  </li>
                  <li>
                    <p>Layouts</p>
                    <ul>
                      <li>
                        <a href="header-center.html">Header Center, Footer Dark</a>
                      </li>
                      <li>
                        <a href="header-minimal.html">Header Minimal, Footer Dark</a>
                      </li>
                      <li>
                        <a href="header-corporate.html">Header Corporate</a>
                      </li>
                      <li>
                        <a href="header-corporate-default.html">Header Corporate Default</a>
                      </li>
                      <li>
                        <a href="header-hamburger.html">Header Hamburger Menu</a>
                      </li>
                      <li>
                        <a href="footer-center-dark.html">Footer Center Dark</a>
                      </li>
                      <li>
                        <a href="footer-light.html">Footer Light</a>
                      </li>
                      <li>
                        <a href="footer-widget.html">Footer Widget Light</a>
                      </li>
                      <li>
                        <a href="footer-widget-dark.html">Footer Widget Dark</a>
                      </li>
                    </ul>
                  </li>
                </ul>
              </li> --}}
              {{-- <li>
                <a href="#">Blog</a>
                <ul class="rd-navbar-dropdown">
                  <li>
                    <a href="2-columns-blog.html">2 Columns Blog</a>
                  </li>
                  <li>
                    <a href="2-columns-blog-masonry.html">2 Columns Blog Masonry</a>
                  </li>
                  <li>
                    <a href="3-columns-grid-blog.html">3 Columns Blog</a>
                  </li>
                  <li>
                    <a href="3-columns-masonry-layout.html">3 Columns Blog Masonry</a>
                  </li>
                  <li>
                    <a href="left-sidebar.html">Blog Left Sidebar</a>
                  </li>
                  <li>
                    <a href="right-sidebar.html">Blog Right Sidebar</a>
                  </li>
                  <li>
                    <a href="post-page.html">Post Page</a>
                  </li>
                  <li>
                    <a href="timeline.html">Timeline</a>
                  </li>
                </ul>
              </li>
              <li>
                <a href="#">Gallery</a>
                <ul class="rd-navbar-dropdown">
                  <li>
                    <a href="grid-padding-gallery.html">Grid Padding Gallery</a>
                  </li>
                  <li>
                    <a href="without-padding-grid-gallery.html">Grid Without Padding Gallery</a>
                  </li>
                  <li>
                    <a href="masonry-grid.html">Grid Masonry</a>
                  </li>
                  <li>
                    <a href="cobbles-grid.html">Grid Cobbles</a>
                  </li>
                </ul>
              </li> --}}
              <li class="link-group">
                <a href="submit-property.html" class="btn btn-sm btn-primary">Submit Property</a>
              </li>
              <li class="rd-navbar-bottom-panel">
                <div class="rd-navbar-bottom-panel-wrap">
                  <dl class="dl-horizontal-mod-1 login">
                    <dt>
                      <span class="mdi mdi-login icon-xxs-mod-2"></span>
                    </dt>
                    <dd>
                      <a href="login.html" class="text-sushi">Login/Registration</a>
                    </dd>
                  </dl>
                  <div class="top-panel-inner">
                    <dl class="dl-horizontal-mod-1">
                      <dt>
                        <span class="icon-xxs-mod-2 material-icons-local_phone"></span>
                      </dt>
                      <dd>
                        <a href="callto:#">1-800-1234-567</a>
                      </dd>
                    </dl>
                    <dl class="dl-horizontal-mod-1">
                      <dt>
                        <span class="material-icons-drafts icon-xxs-mod-2"></span>
                      </dt>
                      <dd>
                        <a href="mailto:#">info@demolink.org</a>
                      </dd>
                    </dl>
                    <address>
                      <dl class="dl-horizontal-mod-1">
                        <dt>
                          <span class="icon-xxs-mod-2 mdi mdi-map-marker-radius"></span>
                        </dt>
                        <dd>
                          <a href="#" class="inset-11">795 Folsom Ave, Suite 600 San Francisco, CA 94107</a>
                        </dd>
                      </dl>
                    </address>
                  </div>
                  <ul class="list-inline">
                    <li>
                      <a href="#" class="fa-facebook"></a>
                    </li>
                    <li>
                      <a href="#" class="fa-twitter"></a>
                    </li>
                    <li>
                      <a href="#" class="fa-pinterest-p"></a>
                    </li>
                    <li>
                      <a href="#" class="fa-vimeo"></a>
                    </li>
                    <li>
                      <a href="#" class="fa-google"></a>
                    </li>
                    <li>
                      <a href="#" class="fa-rss"></a>
                    </li>
                  </ul>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </header>
