<div class="bg-black text-white py-8">
    <div class="container mx-auto px-4">
        <!-- Top Row with Links -->
        <div class="flex flex-wrap justify-between items-center border-b border-gray-700 pb-4 mb-4">
            <div class="flex space-x-8">
                <a href="#" class="flex items-center space-x-2 hover:underline">
                    <i class="fas fa-map-marker-alt"></i>
                    <span>Find a Reseller</span>
                </a>
                <a href="#" class="flex items-center space-x-2 hover:underline">
                    <i class="fas fa-headset"></i>
                    <span>Customer Service</span>
                </a>
            </div>
        </div>

        <!-- Middle Row with Sections -->
        <div class="grid grid-cols-1 md:grid-cols-5 gap-8 mb-8">
            <!-- About -->
            <div>
                <h4 class="font-bold mb-4">About</h4>
                <ul>
                    <li><a href="#" class="hover:underline">About Us</a></li>
                    <li><a href="#" class="hover:underline">Newsroom</a></li>
                    <li><a href="#" class="hover:underline">Careers</a></li>
                    <li><a href="#" class="hover:underline">Our Values</a></li>
                    <li><a href="#" class="hover:underline">Affiliates</a></li>
                    <li><a href="#" class="hover:underline">Events</a></li>
                    <li><a href="#" class="hover:underline">Gift Cards</a></li>
                </ul>
            </div>
            <!-- My Rewards -->
            <div>
                <h4 class="font-bold mb-4">My Account</h4>
                <ul>
                    <li><a href="#" class="hover:underline">Beauty Insider</a></li>
                    <li><a href="#" class="hover:underline">Order Status</a></li>
                    <li><a href="#" class="hover:underline">Purchase History</a></li>
                    <li><a href="#" class="hover:underline">Account Settings</a></li>
                </ul>
            </div>
            <!-- Help -->
            <div>
                <h4 class="font-bold mb-4">Help</h4>
                <ul>
                    <li><a href="#" class="hover:underline">Customer Service</a></li>
                    <li><a href="#" class="hover:underline">Returns & Exchanges</a></li>
                    <li><a href="#" class="hover:underline">Delivery and Pickup Options</a></li>
                    <li><a href="#" class="hover:underline">Shipping</a></li>
                    <li><a href="#" class="hover:underline">Billing</a></li>
                </ul>
            </div>
            <!-- Payment Options -->
            <div>
                <h4 class="font-bold mb-4">Payment Options</h4>
                <ul class="flex flex-row">
                    @for($i = 1; $i <= 4; $i++)
                        <li class="flex items-center space-x-2 w-1/6 md:w-1/4 lg:w-1/6">
                            <!-- Payment SVG -->
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                <path d="M3 3h18v18H3V3zm14.5 12.5h-3v-5h3v5zm-4.5 0h-3v-5h3v5zm-4.5 0H5v-5h3v5z"></path>
                            </svg>
                        </li>
                    @endfor
                </ul>
            </div>
            <!-- Sign Up for Updates -->
            <div class="flex flex-col justify-between">
                <div>
                    <p class="font-bold mb-4">Inspirational Quote</p>
                </div>
                <div>
                    <h4 class="font-bold mb-4">Sign Up for Updates</h4>
                    <div>
                        <input type="text" placeholder="Enter your email address" class="w-full px-4 py-2 rounded bg-gray-800 text-white placeholder-gray-400">
                        <button class="w-full mt-2 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Sign Up</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bottom Row with Social Media Links and Copyright -->
        <div class="flex flex-row md:flex-row justify-between items-center text-gray-400 text-sm border-t border-gray-700 pt-4">
            <div class="mb-4 md:mb-0">
                <p>© 2024 MakeUp INDONESIA, Inc. All rights reserved.</p>
                <div class="space-x-4">
                    <a href="#" class="hover:underline">Privacy Policy</a>
                    <a href="#" class="hover:underline">Terms of Use</a>
                    <a href="#" class="hover:underline">Accessibility</a>
                    <a href="#" class="hover:underline">Sitemap</a>
                </div>
            </div>
            <div class="flex space-x-4">
                <!-- Social Media Icons -->
                <a href="#" class="hover:text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="text-white" height="40">
                        <title>facebook</title>
                        <path d="M12 2.04C6.5 2.04 2 6.53 2 12.06C2 17.06 5.66 21.21 10.44 21.96V14.96H7.9V12.06H10.44V9.85C10.44 7.34 11.93 5.96 14.22 5.96C15.31 5.96 16.45 6.15 16.45 6.15V8.62H15.19C13.95 8.62 13.56 9.39 13.56 10.18V12.06H16.34L15.89 14.96H13.56V21.96A10 10 0 0 0 22 12.06C22 6.53 17.5 2.04 12 2.04Z" /></svg>
                </a>
                <a href="#" class="hover:text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="text-white" height="40">
                        <title>instagram</title>
                        <path d="M7.8,2H16.2C19.4,2 22,4.6 22,7.8V16.2A5.8,5.8 0 0,1 16.2,22H7.8C4.6,22 2,19.4 2,16.2V7.8A5.8,5.8 0 0,1 7.8,2M7.6,4A3.6,3.6 0 0,0 4,7.6V16.4C4,18.39 5.61,20 7.6,20H16.4A3.6,3.6 0 0,0 20,16.4V7.6C20,5.61 18.39,4 16.4,4H7.6M17.25,5.5A1.25,1.25 0 0,1 18.5,6.75A1.25,1.25 0 0,1 17.25,8A1.25,1.25 0 0,1 16,6.75A1.25,1.25 0 0,1 17.25,5.5M12,7A5,5 0 0,1 17,12A5,5 0 0,1 12,17A5,5 0 0,1 7,12A5,5 0 0,1 12,7M12,9A3,3 0 0,0 9,12A3,3 0 0,0 12,15A3,3 0 0,0 15,12A3,3 0 0,0 12,9Z" />
                    </svg>
                </a>
                <a href="#" class="hover:text-white">
                    <svg fill="currentColor" class="text-white" height="40" viewBox="0 0 512 512" id="icons" xmlns="http://www.w3.org/2000/svg">
                        <path d="M412.19,118.66a109.27,109.27,0,0,1-9.45-5.5,132.87,132.87,0,0,1-24.27-20.62c-18.1-20.71-24.86-41.72-27.35-56.43h.1C349.14,23.9,350,16,350.13,16H267.69V334.78c0,4.28,0,8.51-.18,12.69,0,.52-.05,1-.08,1.56,0,.23,0,.47-.05.71,0,.06,0,.12,0,.18a70,70,0,0,1-35.22,55.56,68.8,68.8,0,0,1-34.11,9c-38.41,0-69.54-31.32-69.54-70s31.13-70,69.54-70a68.9,68.9,0,0,1,21.41,3.39l.1-83.94a153.14,153.14,0,0,0-118,34.52,161.79,161.79,0,0,0-35.3,43.53c-3.48,6-16.61,30.11-18.2,69.24-1,22.21,5.67,45.22,8.85,54.73v.2c2,5.6,9.75,24.71,22.38,40.82A167.53,167.53,0,0,0,115,470.66v-.2l.2.2C155.11,497.78,199.36,496,199.36,496c7.66-.31,33.32,0,62.46-13.81,32.32-15.31,50.72-38.12,50.72-38.12a158.46,158.46,0,0,0,27.64-45.93c7.46-19.61,9.95-43.13,9.95-52.53V176.49c1,.6,14.32,9.41,14.32,9.41s19.19,12.3,49.13,20.31c21.48,5.7,50.42,6.9,50.42,6.9V131.27C453.86,132.37,433.27,129.17,412.19,118.66Z"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</div>
