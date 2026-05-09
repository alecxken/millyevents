<?php
namespace Database\Seeders;
use App\Models\User;
use App\Models\Event;
use App\Models\CarouselSlide;
use App\Models\Note;
use App\Models\TestPlan;
use App\Models\TestCase;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin user
        $admin = User::create([
            'name'     => 'Admin User',
            'email'    => 'admin@milyvents.com',
            'password' => Hash::make('password'),
            'is_admin' => true,
        ]);

        // Regular user
        $user = User::create([
            'name'     => 'Jane Wanjiku',
            'email'    => 'jane@milyvents.com',
            'password' => Hash::make('password'),
            'is_admin' => false,
        ]);

        // Events
        $events = [
            [
                'title'       => 'The Grand Annual Gala Night',
                'description' => 'An evening of elegance, networking and celebration bringing together Africa\'s most distinguished professionals.',
                'category'    => 'Gala',
                'venue'       => 'Nairobi Serena Hotel',
                'location'    => 'Nairobi, Kenya',
                'start_date'  => '2025-09-14 18:00:00',
                'end_date'    => '2025-09-14 23:00:00',
                'price'       => 12000,
                'capacity'    => 300,
                'slots_taken' => 210,
                'status'      => 'upcoming',
                'featured'    => true,
            ],
            [
                'title'       => 'Africa Business Innovation Summit 2025',
                'description' => 'Three days of strategic dialogue, leadership workshops and high-impact networking across Pan-African markets.',
                'category'    => 'Business Summit',
                'venue'       => 'Kigali Convention Centre',
                'location'    => 'Kigali, Rwanda',
                'start_date'  => '2025-10-22 08:00:00',
                'end_date'    => '2025-10-24 18:00:00',
                'price'       => 8500,
                'capacity'    => 500,
                'slots_taken' => 320,
                'status'      => 'upcoming',
                'featured'    => true,
            ],
            [
                'title'       => 'Creative Arts & Culture Festival',
                'description' => 'A vibrant celebration of African art, music, dance and culinary experiences.',
                'category'    => 'Festival',
                'venue'       => 'KICC Grounds',
                'location'    => 'Nairobi, Kenya',
                'start_date'  => '2025-11-08 10:00:00',
                'end_date'    => '2025-11-10 20:00:00',
                'price'       => 3500,
                'capacity'    => 1000,
                'slots_taken' => 450,
                'status'      => 'upcoming',
                'featured'    => false,
            ],
            [
                'title'       => 'Tech Leaders Breakfast Series',
                'description' => 'Monthly intimate breakfast sessions with East Africa\'s top technology executives and innovators.',
                'category'    => 'Networking',
                'venue'       => 'The Sankara Nairobi',
                'location'    => 'Nairobi, Kenya',
                'start_date'  => '2025-10-05 07:30:00',
                'end_date'    => '2025-10-05 10:30:00',
                'price'       => 4500,
                'capacity'    => 60,
                'slots_taken' => 55,
                'status'      => 'upcoming',
                'featured'    => false,
            ],
            [
                'title'       => 'Corporate Leadership Retreat',
                'description' => 'A transformative 2-day retreat for senior executives focusing on strategic leadership and team cohesion.',
                'category'    => 'Corporate',
                'venue'       => 'Lake Naivasha Resort',
                'location'    => 'Naivasha, Kenya',
                'start_date'  => '2025-12-01 09:00:00',
                'end_date'    => '2025-12-02 17:00:00',
                'price'       => 25000,
                'capacity'    => 40,
                'slots_taken' => 18,
                'status'      => 'upcoming',
                'featured'    => false,
            ],
        ];

        $createdEvents = [];
        foreach ($events as $ev) {
            $createdEvents[] = Event::create(array_merge($ev, ['created_by' => $admin->id]));
        }

        // Carousel slides
        CarouselSlide::create([
            'tag'                 => 'Featured Event',
            'headline'            => "The Grand\nAnnual\nGala Night",
            'sub_text'            => "An evening of elegance, networking and celebration bringing together Africa's most distinguished professionals.",
            'btn_primary_label'   => 'Reserve a Seat',
            'btn_secondary_label' => 'Learn More',
            'date_display'        => '14 September 2025',
            'venue_display'       => 'Nairobi Serena Hotel',
            'price_display'       => 'KES 12,000',
            'bg_color'            => '#07332c',
            'sort_order'          => 1,
            'event_id'            => $createdEvents[0]->id,
        ]);
        CarouselSlide::create([
            'tag'                 => 'Business Summit',
            'headline'            => "Africa Business\nInnovation\nSummit 2025",
            'sub_text'            => 'Three days of strategic dialogue, leadership workshops and high-impact networking across Pan-African markets.',
            'btn_primary_label'   => 'Register Now',
            'btn_secondary_label' => 'View Programme',
            'date_display'        => '22–24 October 2025',
            'venue_display'       => 'Kigali Convention Centre',
            'price_display'       => 'KES 8,500',
            'bg_color'            => '#485b46',
            'sort_order'          => 2,
            'event_id'            => $createdEvents[1]->id,
        ]);
        CarouselSlide::create([
            'tag'                 => 'Festival',
            'headline'            => "Creative Arts\n& Culture\nFestival",
            'sub_text'            => 'A vibrant celebration of African art, music, dance and culinary experiences.',
            'btn_primary_label'   => 'Get Tickets',
            'btn_secondary_label' => 'Explore',
            'date_display'        => '8–10 November 2025',
            'venue_display'       => 'KICC Grounds',
            'price_display'       => 'KES 3,500',
            'bg_color'            => '#1a2420',
            'sort_order'          => 3,
            'event_id'            => $createdEvents[2]->id,
        ]);

        // Notes
        Note::create([
            'user_id' => $user->id,
            'event_id'=> $createdEvents[0]->id,
            'title'   => 'Gala Night Preparations',
            'body'    => 'Need to confirm table allocation with the venue. Check dress code requirements for all attendees.',
            'color'   => '#f7f4ef',
            'pinned'  => true,
        ]);
        Note::create([
            'user_id' => $user->id,
            'event_id'=> $createdEvents[1]->id,
            'title'   => 'Summit Speaker Notes',
            'body'    => 'Key sessions to attend: Day 1 keynote at 9am, FinTech panel at 2pm, Networking dinner at 7pm.',
            'color'   => '#edf4f9',
            'pinned'  => false,
        ]);
        Note::create([
            'user_id' => $user->id,
            'event_id'=> null,
            'title'   => 'General Event Ideas',
            'body'    => 'Consider adding a hybrid/virtual attendance option for future events. Explore partnerships with Safaricom for mobile ticketing.',
            'color'   => '#eef6f0',
            'pinned'  => false,
        ]);

        // Test Plan
        $plan = TestPlan::create([
            'user_id'               => $user->id,
            'name'                  => 'Milyvents PWA — System Test Plan',
            'description'           => 'Comprehensive test plan for the Milyvents event management PWA covering all core modules.',
            'features_to_test'      => "- User Registration & Login\n- Event Browsing & Search\n- Ticket Booking Flow\n- Notes Module\n- Admin Event CRUD\n- Admin Carousel Management\n- PWA Install & Offline Mode\n- PDF Export",
            'features_not_to_test'  => "- Third-party payment gateway internals\n- Email delivery infrastructure\n- Social media integrations",
            'pass_criteria'         => "All critical test cases pass with no blockers. Non-critical failures documented with workarounds.",
            'fail_criteria'         => "Any critical test case fails or data integrity is compromised.",
            'approach'              => "Manual functional testing using a staging environment with seeded SQLite database. PWA tested on Chrome (Android) and Safari (iOS).",
            'testing_materials'     => "- Chrome v124+ browser\n- Android device (Pixel 6)\n- SQLite database with seed data\n- Postman for API endpoint verification",
            'conclusion'            => 'All core features tested and verified. System is stable and ready for production deployment.',
            'recommendation'        => 'Add automated regression tests for the booking flow. Implement end-to-end tests with Playwright.',
            'status'                => 'active',
        ]);

        $cases = [
            ['name'=>'User Registration', 'description'=>'Verify a new user can register successfully.', 'steps'=>"1. Navigate to /register\n2. Fill in name, email, password\n3. Click Register", 'expected_result'=>'User is created and redirected to dashboard.', 'priority'=>'critical'],
            ['name'=>'User Login', 'description'=>'Verify registered user can log in.', 'steps'=>"1. Navigate to /login\n2. Enter credentials\n3. Click Sign In", 'expected_result'=>'User is authenticated and dashboard is visible.', 'priority'=>'critical'],
            ['name'=>'Event Listing', 'description'=>'Verify events display on the home page.', 'steps'=>"1. Open the home page\n2. Scroll to Featured Events", 'expected_result'=>'At least 3 event cards are visible with title, date, and price.', 'priority'=>'high'],
            ['name'=>'Book an Event', 'description'=>'Verify user can book an event.', 'steps'=>"1. Log in\n2. Click an event\n3. Click Book Now\n4. Confirm booking", 'expected_result'=>'Booking created with reference number. Slots taken incremented.', 'priority'=>'critical'],
            ['name'=>'Create a Note', 'description'=>'Verify user can create a note.', 'steps'=>"1. Navigate to Notes tab\n2. Click New Note\n3. Enter title and body\n4. Save", 'expected_result'=>'Note saved and visible in notes list.', 'priority'=>'high'],
            ['name'=>'Admin Create Event', 'description'=>'Verify admin can create a new event.', 'steps'=>"1. Log in as admin\n2. Go to Admin > Events\n3. Click New Event\n4. Fill form and save", 'expected_result'=>'Event created and visible on public listing.', 'priority'=>'high'],
            ['name'=>'PWA Install Prompt', 'description'=>'Verify PWA install prompt appears on mobile.', 'steps'=>"1. Open site on Chrome Android\n2. Wait for install banner", 'expected_result'=>'Add to Home Screen prompt appears.', 'priority'=>'medium'],
            ['name'=>'Export Test Results PDF', 'description'=>'Verify test results can be exported as PDF.', 'steps'=>"1. Navigate to test plan\n2. Click Export PDF button", 'expected_result'=>'PDF downloaded with all test cases and results.', 'priority'=>'high'],
        ];

        foreach ($cases as $i => $c) {
            TestCase::create(array_merge($c, ['test_plan_id' => $plan->id, 'sort_order' => $i + 1, 'preconditions' => 'User must be logged in.']));
        }
    }
}
