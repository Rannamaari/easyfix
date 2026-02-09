<?php

namespace Database\Seeders;

use App\Models\BlogPost;
use Illuminate\Database\Seeder;

class BlogPostSeeder extends Seeder
{
    public function run(): void
    {
        $posts = [
            // 1
            [
                'title' => 'How to Service Your AC at Home — No Technician Needed',
                'slug' => 'how-to-service-your-ac-at-home',
                'excerpt' => 'Your AC works overtime in Malé\'s heat. Learn simple maintenance steps you can do yourself to keep it running efficiently and avoid costly breakdowns.',
                'meta_title' => 'DIY AC Service at Home | Easy Fix Malé',
                'meta_description' => 'Learn how to clean AC filters, coils, and drain lines yourself. Simple home AC maintenance tips for Malé residents to save money and stay cool.',
                'content' => <<<'HTML'
<p>Living in Malé means your air conditioner is probably the hardest-working appliance in your home. The tropical heat and humidity put serious strain on AC units, but the good news is — a lot of basic maintenance doesn't require a technician.</p>

<p>Here's what you can do yourself to keep your AC running smoothly and your electricity bill in check.</p>

<h2>1. Clean or Replace the Filters (Every 2 Weeks)</h2>
<p>This is the single most impactful thing you can do. Dirty filters block airflow, force the compressor to work harder, and drive up your electricity bill.</p>
<ul>
<li>Open the front panel of your indoor unit — it usually lifts up</li>
<li>Slide out the mesh filters</li>
<li>Wash them under running water with a little dish soap</li>
<li>Let them dry completely before putting them back</li>
</ul>
<p><strong>Pro tip:</strong> If you have pets or live near a construction site, clean filters weekly instead of fortnightly.</p>

<h2>2. Clean the Indoor Unit's Evaporator Coils</h2>
<p>Over time, dust builds up on the cooling coils behind the filters, reducing efficiency.</p>
<ul>
<li>Turn off the AC and unplug it</li>
<li>Remove the filters</li>
<li>Use a soft brush or a can of compressed air to gently remove dust from the coils</li>
<li>You can also spray a no-rinse AC coil cleaner (available at hardware stores in Malé)</li>
</ul>

<h2>3. Clear the Drain Line</h2>
<p>The AC removes humidity from the air, and that water drains out through a pipe. If it gets clogged, water leaks inside your room.</p>
<ul>
<li>Find the drain pipe — it usually exits through the wall near the outdoor unit</li>
<li>Pour a cup of white vinegar or warm water through the drain line every month</li>
<li>If water is already leaking from the indoor unit, the drain pan or pipe is likely blocked</li>
</ul>

<h2>4. Keep the Outdoor Unit Clean</h2>
<p>The condenser unit outside needs airflow to release heat. In Malé's dusty environment, the fins get clogged fast.</p>
<ul>
<li>Turn off the AC</li>
<li>Gently hose down the outdoor unit to remove dust and debris</li>
<li>Make sure nothing is blocking airflow around it — keep at least 30cm of clearance</li>
<li>Straighten any bent fins with a fin comb (or a butter knife, carefully)</li>
</ul>

<h2>5. Check the Thermostat Settings</h2>
<p>Set your AC to 24–25°C. Every degree lower increases power consumption by about 6%. In Malé's climate, 24°C is comfortable for most people and significantly cheaper than 18°C.</p>

<h2>When to Call a Professional</h2>
<p>DIY maintenance covers the basics, but some things need a trained technician:</p>
<ul>
<li><strong>Gas refill</strong> — if the AC blows air but it's not cold, the refrigerant may be low</li>
<li><strong>Strange noises</strong> — grinding, rattling, or clicking sounds from the compressor</li>
<li><strong>Electrical issues</strong> — the unit trips the breaker or won't turn on</li>
<li><strong>Ice on the coils</strong> — this usually means low refrigerant or airflow problems</li>
</ul>
<p>For these situations, <strong>Easy Fix</strong> can have a technician at your door the same day.</p>
HTML,
                'is_published' => true,
                'published_at' => now()->subDays(1),
            ],

            // 2
            [
                'title' => 'Fridge Not Cooling? 7 Things to Check Before Calling a Repairman',
                'slug' => 'fridge-not-cooling-troubleshooting-guide',
                'excerpt' => 'Before you panic about spoiled food, try these simple fridge troubleshooting steps. Most common cooling problems have surprisingly easy fixes.',
                'meta_title' => 'Fridge Not Cooling? DIY Troubleshooting Guide | Easy Fix',
                'meta_description' => 'Your fridge stopped cooling? Check these 7 things before calling a repairman. Simple troubleshooting tips that could save you a service call.',
                'content' => <<<'HTML'
<p>A fridge that stops cooling is a genuine emergency — especially in Malé's heat, where food can spoil within hours. But before you call a technician, run through these checks. You might fix it yourself in minutes.</p>

<h2>1. Check the Temperature Settings</h2>
<p>It sounds obvious, but someone might have accidentally bumped the dial. Make sure the thermostat is set between 2–4°C for the fridge and -18°C for the freezer. If you have a digital display, check that it hasn't been reset.</p>

<h2>2. Is the Door Sealing Properly?</h2>
<p>A worn or dirty door gasket (the rubber seal) lets warm air in constantly, making the compressor work overtime without actually cooling.</p>
<ul>
<li><strong>The dollar bill test:</strong> Close the door on a piece of paper. If you can pull it out easily, the seal is weak</li>
<li>Clean the gasket with warm soapy water — grease and food residue prevent a tight seal</li>
<li>Check for cracks or tears in the rubber</li>
</ul>

<h2>3. Don't Overstuff (or Understuff) It</h2>
<p>A fridge needs air circulation to cool evenly. If it's packed wall-to-wall, cold air can't flow. On the flip side, a nearly empty fridge loses cold air faster every time you open the door.</p>
<p><strong>The sweet spot:</strong> About 75% full, with some space between items.</p>

<h2>4. Clean the Condenser Coils</h2>
<p>The coils at the back or bottom of your fridge release heat. When they're covered in dust, the fridge can't cool efficiently.</p>
<ul>
<li>Unplug the fridge</li>
<li>Find the coils — usually at the back or behind a bottom grille</li>
<li>Vacuum them with a brush attachment, or use a long-handled duster</li>
<li>Do this every 6 months</li>
</ul>

<h2>5. Check the Evaporator Fan</h2>
<p>Open the freezer and listen. You should hear a fan running. If it's silent, the evaporator fan might be stuck or broken. This fan circulates cold air from the freezer to the fridge compartment.</p>
<ul>
<li>Check if ice has built up around the fan — a manual defrost might fix it</li>
<li>If the fan motor is dead, that's a repair job for a technician</li>
</ul>

<h2>6. Is It Getting Enough Ventilation?</h2>
<p>Your fridge needs breathing room. If it's wedged tightly between cabinets or pushed flush against the wall, it can't release heat properly.</p>
<ul>
<li>Leave at least 5cm of space behind the fridge</li>
<li>Ensure the sides have some clearance too</li>
<li>In Malé's small kitchens this is tricky, but even a little gap helps</li>
</ul>

<h2>7. Listen to the Compressor</h2>
<p>The compressor is the motor that actually cools the fridge. Put your ear near the bottom back of the fridge.</p>
<ul>
<li><strong>Humming normally?</strong> The compressor is working — the problem is likely elsewhere</li>
<li><strong>Clicking on and off?</strong> Could be a faulty start relay (cheap to replace)</li>
<li><strong>Silent?</strong> The compressor may have failed — this is the most expensive repair</li>
</ul>

<h2>When It's Time to Call Easy Fix</h2>
<p>If you've checked all seven and the fridge still isn't cooling, you likely need a professional. Common culprits include a faulty thermostat, dead compressor, or refrigerant leak — all things our technicians handle regularly.</p>
HTML,
                'is_published' => true,
                'published_at' => now()->subDays(3),
            ],

            // 3
            [
                'title' => 'Microwave Not Heating? Here\'s How to Troubleshoot It',
                'slug' => 'microwave-not-heating-troubleshooting',
                'excerpt' => 'Your microwave runs but food comes out cold? Before replacing it, try these troubleshooting steps to identify the problem.',
                'meta_title' => 'Microwave Not Heating? Troubleshooting Guide | Easy Fix',
                'meta_description' => 'Microwave turns on but doesn\'t heat? Learn the common causes and safe troubleshooting steps before deciding on repair or replacement.',
                'content' => <<<'HTML'
<p>Few things are more frustrating than putting food in the microwave, hearing it hum for two minutes, and pulling out a plate that's still stone cold. Here's how to figure out what's going on — and what's safe to fix yourself.</p>

<h2>Important Safety Warning</h2>
<p><strong>Microwaves contain a high-voltage capacitor that can hold a lethal charge even when unplugged.</strong> Never open the microwave casing or attempt internal repairs yourself. The troubleshooting steps below are all external and safe.</p>

<h2>1. Check the Basics First</h2>
<ul>
<li><strong>Power level:</strong> Make sure it's set to full power (100%), not defrost or a lower level</li>
<li><strong>Timer:</strong> Confirm you're setting enough time — some foods need longer than you think</li>
<li><strong>Outlet:</strong> Try plugging something else into the same outlet to confirm it's working</li>
</ul>

<h2>2. Test with a Cup of Water</h2>
<p>Place a microwave-safe cup of water inside and run it on high for one minute.</p>
<ul>
<li><strong>Water is hot?</strong> The microwave is fine — your food might need more time or different placement</li>
<li><strong>Water is lukewarm?</strong> The magnetron might be weakening</li>
<li><strong>Water is cold?</strong> The microwave isn't generating heat at all</li>
</ul>

<h2>3. Inspect the Door Switches</h2>
<p>Microwaves have safety switches that detect whether the door is fully closed. If one fails, the microwave may run the turntable and light but not actually heat.</p>
<ul>
<li>Close the door firmly — listen for a solid click</li>
<li>Check if the door latch is bent or damaged</li>
<li>Look at the door seal for food debris preventing a complete close</li>
</ul>

<h2>4. Check the Turntable</h2>
<p>If the turntable isn't spinning, food heats unevenly and might seem like the microwave isn't working.</p>
<ul>
<li>Make sure the turntable is seated properly on its guide</li>
<li>Clean the roller ring and the bottom of the turntable</li>
<li>Check that the turntable motor is engaging</li>
</ul>

<h2>5. Look for Sparking or Burning Smells</h2>
<p>If you notice sparks or a burning smell, <strong>stop using the microwave immediately</strong>.</p>
<ul>
<li><strong>Sparking from the walls:</strong> The waveguide cover (a small panel inside) might be damaged or have food splatter on it</li>
<li><strong>Burning smell:</strong> Could be the magnetron or a wiring issue — unplug it</li>
</ul>

<h2>6. Consider the Age</h2>
<p>Microwaves typically last 7–10 years. If yours is older and not heating properly, the magnetron (the component that generates microwaves) is likely wearing out. Replacing a magnetron often costs more than buying a new microwave.</p>

<h2>Repair or Replace?</h2>
<p>As a rule of thumb:</p>
<ul>
<li><strong>Under 5 years old:</strong> Worth repairing (usually a door switch or diode)</li>
<li><strong>5–8 years old:</strong> Get a quote first — compare repair cost vs. a new unit</li>
<li><strong>Over 8 years old:</strong> Probably more economical to replace</li>
</ul>
<p>If you need help deciding, Easy Fix can diagnose the problem and give you an honest recommendation.</p>
HTML,
                'is_published' => true,
                'published_at' => now()->subDays(5),
            ],

            // 4
            [
                'title' => 'How to Choose the Right Painter for Your Home in Malé',
                'slug' => 'how-to-choose-a-painter-male',
                'excerpt' => 'Hiring a painter can go very right or very wrong. Here\'s what to look for, what to ask, and red flags to watch out for when choosing a painter in Malé.',
                'meta_title' => 'How to Choose a House Painter in Malé | Easy Fix Guide',
                'meta_description' => 'Hiring a painter in Malé? Learn what to look for, questions to ask, and red flags to avoid. A practical guide from Easy Fix.',
                'content' => <<<'HTML'
<p>Whether you're refreshing a single room or repainting your entire apartment, choosing the right painter makes the difference between a job you love and months of regret. Here's a practical guide for hiring a painter in Malé.</p>

<h2>1. Ask to See Previous Work</h2>
<p>Any decent painter should be able to show you photos of past jobs, or better yet, give you an address you can visit. Look for:</p>
<ul>
<li>Clean, straight edges where walls meet the ceiling</li>
<li>Even coverage with no drips or runs</li>
<li>Neat work around switches, outlets, and door frames</li>
</ul>
<p>If they can't show you anything, that's a red flag.</p>

<h2>2. Get a Detailed Quote — Not Just a Number</h2>
<p>A good quote should break down:</p>
<ul>
<li><strong>Paint cost</strong> — brand, type (matte, satin, gloss), and how many coats</li>
<li><strong>Labour cost</strong> — per room, per day, or a flat rate for the whole job</li>
<li><strong>Preparation work</strong> — sanding, filling cracks, priming</li>
<li><strong>What's included</strong> — do they move furniture? Cover floors? Clean up after?</li>
</ul>
<p>Watch out for quotes that seem too cheap — they usually mean fewer coats, cheap paint, or skipped prep work.</p>

<h2>3. Understand Paint Quality</h2>
<p>In Malé's humid, salty climate, paint quality matters more than most places.</p>
<ul>
<li><strong>For interior walls:</strong> A good quality emulsion (washable is best for families)</li>
<li><strong>For bathrooms and kitchens:</strong> Moisture-resistant paint is essential</li>
<li><strong>For exterior walls:</strong> Weather-resistant, UV-stable paint</li>
<li><strong>Two coats minimum</strong> — one coat never looks good and doesn't last</li>
</ul>

<h2>4. Check How They Prepare Surfaces</h2>
<p>Preparation is 80% of a good paint job. Ask specifically:</p>
<ul>
<li>Will they fill cracks and holes?</li>
<li>Will they sand rough areas?</li>
<li>Will they apply primer (especially on new plaster or stained walls)?</li>
<li>Will they mask off areas that shouldn't be painted?</li>
</ul>
<p>If a painter wants to skip straight to painting, find someone else.</p>

<h2>5. Agree on a Timeline</h2>
<p>A typical 2-bedroom apartment in Malé takes 3–5 days for a proper job (including prep and two coats). Be wary of someone who promises to do it in one day — corners will be cut.</p>
<p>Get a start date and expected finish date in writing, along with what happens if they run late.</p>

<h2>6. Discuss Cleanup</h2>
<p>Before they start, agree on who handles:</p>
<ul>
<li>Moving and covering furniture</li>
<li>Protecting floors with drop cloths</li>
<li>Removing paint drips and tape after</li>
<li>Disposing of used paint cans and materials</li>
</ul>

<h2>7. Red Flags to Watch For</h2>
<ul>
<li>No references or portfolio of past work</li>
<li>Wants full payment upfront (a small deposit is normal; full payment is not)</li>
<li>Can't tell you what paint brand they'll use</li>
<li>Quotes significantly lower than everyone else</li>
<li>Doesn't mention prep work at all</li>
</ul>

<h2>The Easy Fix Approach</h2>
<p>When you book a painting job through Easy Fix, we handle the vetting for you. Our painters are experienced, we use quality paints, and every job includes proper prep, two coats, and full cleanup. No surprises, no shortcuts.</p>
HTML,
                'is_published' => true,
                'published_at' => now()->subDays(7),
            ],

            // 5
            [
                'title' => '5 Plumbing Fixes Every Homeowner in Malé Should Know',
                'slug' => '5-plumbing-fixes-every-homeowner-should-know',
                'excerpt' => 'A dripping tap or slow drain doesn\'t always need a plumber. Learn five common plumbing fixes you can handle yourself with basic tools.',
                'meta_title' => '5 Easy Plumbing Fixes You Can Do Yourself | Easy Fix Malé',
                'meta_description' => 'Stop that dripping tap and unclog your drain yourself. Five simple plumbing fixes every Malé homeowner should know.',
                'content' => <<<'HTML'
<p>Plumbing problems have a way of happening at the worst possible time. The good news? Many common issues are simple enough to fix yourself with basic tools and a little confidence. Here are five plumbing fixes every homeowner should know.</p>

<h2>1. Fix a Dripping Tap</h2>
<p>That constant drip isn't just annoying — it wastes litres of water every day and increases your bill.</p>
<p><strong>What you need:</strong> Adjustable wrench, replacement washer (take the old one to the hardware store to match it)</p>
<ol>
<li>Turn off the water supply under the sink</li>
<li>Remove the tap handle (usually a screw under a cap or at the back)</li>
<li>Unscrew the valve and pull out the old washer</li>
<li>Replace with the new washer</li>
<li>Reassemble in reverse order</li>
<li>Turn the water back on and check for leaks</li>
</ol>
<p><strong>Time:</strong> 15–20 minutes</p>

<h2>2. Unclog a Slow Drain</h2>
<p>Before reaching for chemical drain cleaners (which can damage pipes over time), try these methods:</p>
<p><strong>Method 1 — Boiling water:</strong> Pour a full kettle of boiling water slowly down the drain. Repeat 2–3 times. This dissolves soap and grease buildup.</p>
<p><strong>Method 2 — Baking soda + vinegar:</strong></p>
<ol>
<li>Pour half a cup of baking soda down the drain</li>
<li>Follow with half a cup of white vinegar</li>
<li>Cover the drain and wait 30 minutes</li>
<li>Flush with boiling water</li>
</ol>
<p><strong>Method 3 — Manual removal:</strong> Remove the drain cover and pull out the hair and gunk with needle-nose pliers or a zip-it tool. Gross, but effective.</p>

<h2>3. Fix a Running Toilet</h2>
<p>A toilet that keeps running wastes a shocking amount of water. The fix is usually simple.</p>
<ul>
<li><strong>Lift the tank lid</strong> and look inside</li>
<li><strong>Check the flapper</strong> — the rubber disc at the bottom. If it's warped or doesn't seal, replace it (they're universal and cheap)</li>
<li><strong>Check the float</strong> — if the water level is too high, water overflows into the overflow tube. Adjust the float arm down</li>
<li><strong>Check the fill valve</strong> — if it hisses constantly, it may need replacing</li>
</ul>

<h2>4. Stop a Leaking Pipe Joint</h2>
<p>If you spot a small leak at a pipe connection (not a burst pipe), you can often fix it temporarily:</p>
<ul>
<li><strong>For threaded connections:</strong> Tighten slightly with a wrench. If still leaking, wrap the threads with PTFE tape (plumber's tape) and reconnect</li>
<li><strong>For a pinhole leak:</strong> Dry the area, apply epoxy putty as a temporary patch, and call a plumber for a proper fix</li>
</ul>
<p><strong>Important:</strong> If a pipe has burst or you see significant water flow, turn off the main water supply immediately and call for help.</p>

<h2>5. Clear a Blocked Showerhead</h2>
<p>If your shower pressure has dropped, mineral buildup is likely clogging the nozzles — common with Malé's water.</p>
<ol>
<li>Unscrew the showerhead</li>
<li>Soak it in a bowl of white vinegar for 2–4 hours (overnight for heavy buildup)</li>
<li>Scrub the nozzles with an old toothbrush</li>
<li>Rinse and reattach</li>
</ol>

<h2>When to Call Easy Fix</h2>
<p>These DIY fixes handle the basics, but for anything involving the main water line, hidden leaks inside walls, or problems you can't identify — don't risk making it worse. Easy Fix has experienced plumbers who can be at your door the same day.</p>
HTML,
                'is_published' => true,
                'published_at' => now()->subDays(10),
            ],

            // 6
            [
                'title' => 'The Ultimate Deep Cleaning Checklist for Malé Apartments',
                'slug' => 'deep-cleaning-checklist-male-apartments',
                'excerpt' => 'Whether you\'re moving out or just need a reset, here\'s a room-by-room deep cleaning checklist designed for Malé\'s compact apartments.',
                'meta_title' => 'Deep Cleaning Checklist for Malé Apartments | Easy Fix',
                'meta_description' => 'Complete room-by-room deep cleaning checklist for apartments in Malé. Tips for kitchen, bathroom, bedrooms, and dealing with humidity.',
                'content' => <<<'HTML'
<p>Malé's humidity, dust, and compact living spaces mean apartments need a proper deep clean every few months. Whether you're doing a move-out clean, hosting guests, or just hitting the reset button, this room-by-room checklist has you covered.</p>

<h2>Kitchen</h2>
<ul>
<li><strong>Oven & stovetop:</strong> Remove burner grates, soak in hot soapy water. Scrub the stovetop with baking soda paste</li>
<li><strong>Microwave:</strong> Heat a bowl of water with lemon juice for 3 minutes. The steam loosens grime — wipe clean</li>
<li><strong>Fridge:</strong> Remove everything, toss expired items, wipe shelves with warm soapy water. Clean the rubber door seal with a toothbrush</li>
<li><strong>Cabinets:</strong> Wipe inside and outside. Check for expired pantry items</li>
<li><strong>Sink & taps:</strong> Scrub with baking soda. Use white vinegar on limescale buildup around taps</li>
<li><strong>Exhaust fan:</strong> Remove the cover and wash it. Vacuum dust from the fan blades</li>
<li><strong>Behind appliances:</strong> Pull out the fridge and stove. Sweep and mop behind them (you'll be surprised)</li>
</ul>

<h2>Bathroom</h2>
<ul>
<li><strong>Tiles & grout:</strong> Spray grout with a baking soda + vinegar paste. Let it sit 15 minutes, then scrub with a stiff brush</li>
<li><strong>Toilet:</strong> Clean inside with a toilet cleaner, outside with disinfectant. Don't forget the base and behind the bowl</li>
<li><strong>Shower area:</strong> Remove showerhead and soak in vinegar. Scrub glass doors or curtain. Clean drain trap</li>
<li><strong>Mirror & fixtures:</strong> Glass cleaner for mirrors, warm soapy water for fixtures. Dry with a microfiber cloth for streak-free shine</li>
<li><strong>Ventilation:</strong> Clean the exhaust fan. In Malé's humidity, a working bathroom fan is essential to prevent mould</li>
</ul>

<h2>Bedrooms</h2>
<ul>
<li><strong>Mattress:</strong> Strip the bed, sprinkle baking soda on the mattress, let it sit for an hour, then vacuum. This removes odours and moisture</li>
<li><strong>Under the bed:</strong> Vacuum and mop. This is where dust bunnies become dust monsters</li>
<li><strong>Wardrobes:</strong> Empty, wipe shelves, air out. Check for any moisture or mould — common in Malé's humidity</li>
<li><strong>Curtains:</strong> Wash or vacuum. Curtains absorb dust and odours over time</li>
<li><strong>AC unit:</strong> Clean the filters (see our AC maintenance guide)</li>
</ul>

<h2>Living Areas</h2>
<ul>
<li><strong>Ceiling fans:</strong> Wipe each blade — use a damp pillowcase slipped over the blade to catch dust without dropping it</li>
<li><strong>Light fixtures:</strong> Remove covers and wash. Dead insects collect inside — especially in Malé</li>
<li><strong>Behind furniture:</strong> Move sofas and shelving units. Vacuum and mop behind them</li>
<li><strong>Windows:</strong> Clean glass inside and out. Wipe window tracks with a damp cloth and vacuum crevices</li>
<li><strong>Switches & door handles:</strong> Disinfect all frequently touched surfaces</li>
</ul>

<h2>Malé-Specific Tips</h2>
<ul>
<li><strong>Humidity control:</strong> After deep cleaning, run the AC on dry mode for a few hours to prevent mould regrowth</li>
<li><strong>Salt air:</strong> Wipe down metal fixtures and hardware to prevent corrosion from the salty air</li>
<li><strong>Water tank:</strong> If your building has a water tank on the roof, residue can affect your taps and shower. Use a water filter or clean fixtures more frequently</li>
</ul>

<h2>Don't Have the Time?</h2>
<p>We get it — deep cleaning an entire apartment takes a full day. Easy Fix offers professional deep cleaning services with trained staff and proper equipment. We'll leave your apartment spotless so you don't have to spend your day off scrubbing grout.</p>
HTML,
                'is_published' => true,
                'published_at' => now()->subDays(12),
            ],

            // 7
            [
                'title' => '10 Essential Tools Every Homeowner in Malé Should Own',
                'slug' => '10-essential-tools-every-homeowner-should-own',
                'excerpt' => 'You don\'t need a full workshop, but these 10 tools will help you handle most small repairs around your home without calling for help.',
                'meta_title' => '10 Must-Have Tools for Homeowners | Easy Fix Malé',
                'meta_description' => 'The 10 essential tools every homeowner in Malé needs. Handle basic repairs yourself with this practical toolkit guide.',
                'content' => <<<'HTML'
<p>You don't need a shed full of power tools to handle basic home repairs. With these 10 essentials, you can tackle most of the small fixes that come up in a Malé apartment.</p>

<h2>1. A Good Screwdriver Set</h2>
<p>Get a set with both Phillips (cross) and flathead tips in multiple sizes. Even better — a single driver with interchangeable bits. You'll use this for everything from tightening door handles to fixing switch plates.</p>

<h2>2. Adjustable Wrench</h2>
<p>One medium-sized adjustable wrench handles most plumbing connections, furniture assembly, and general tightening jobs. More versatile than a full wrench set.</p>

<h2>3. Hammer</h2>
<p>A 16oz claw hammer covers most needs — hanging pictures, tapping things into place, and pulling out old nails with the claw end.</p>

<h2>4. Tape Measure</h2>
<p>A 5-metre tape measure is essential for buying curtains, furniture, or appliances that actually fit your space. Malé apartments have non-standard dimensions — never assume.</p>

<h2>5. Utility Knife</h2>
<p>For opening packages, cutting tape, trimming edges, stripping wire insulation, and dozens of other tasks. Get one with retractable blades for safety.</p>

<h2>6. Pliers (Combination & Needle-Nose)</h2>
<p>Combination pliers grip, twist, and cut wire. Needle-nose pliers reach into tight spaces — perfect for pulling hair clogs from drains or holding small parts.</p>

<h2>7. Spirit Level</h2>
<p>A small spirit level ensures your shelves, picture frames, and curtain rods are actually straight. Your eye is not as reliable as you think.</p>

<h2>8. Plumber's Tape (PTFE Tape)</h2>
<p>This thin white tape wraps around threaded pipe connections to prevent leaks. Costs almost nothing and saves you from calling a plumber for a dripping connection. Keep a roll under the sink.</p>

<h2>9. Voltage Tester</h2>
<p>Before touching any electrical work — even just replacing a switch — a non-contact voltage tester tells you if a wire is live. They're cheap, pen-sized, and could save your life.</p>

<h2>10. Cordless Drill</h2>
<p>This is the one power tool worth investing in. Use it for hanging shelves, assembling furniture, drilling into walls for hooks and brackets. A basic model from any Malé hardware store will last years.</p>

<h2>Bonus: Keep These Supplies Handy</h2>
<ul>
<li>Assorted screws, nails, and wall anchors</li>
<li>Electrical tape and insulation tape</li>
<li>Super glue and wood glue</li>
<li>WD-40 or silicone spray for squeaky hinges</li>
<li>Sandpaper (medium grit) for smoothing rough edges</li>
</ul>

<h2>Know Your Limits</h2>
<p>These tools handle the basics, but for anything involving your home's electrical panel, main plumbing lines, or structural work — call a professional. Easy Fix is one call away for the jobs that go beyond a basic toolkit.</p>
HTML,
                'is_published' => true,
                'published_at' => now()->subDays(14),
            ],

            // 8
            [
                'title' => 'Why Your Electricity Bill Is So High (and How to Fix It)',
                'slug' => 'reduce-electricity-bill-male-tips',
                'excerpt' => 'Malé residents pay some of the highest electricity rates in the region. Here are practical ways to cut your bill without sacrificing comfort.',
                'meta_title' => 'How to Reduce Your Electricity Bill in Malé | Easy Fix',
                'meta_description' => 'Practical tips to lower your electricity bill in Malé. From AC settings to appliance habits, learn where your money is going.',
                'content' => <<<'HTML'
<p>Electricity in Malé isn't cheap, and most of the bill comes from just a few appliances. Here's where your money is going and what you can do about it — without living in the dark or sweating through the night.</p>

<h2>The Biggest Power Consumers</h2>
<p>In a typical Malé apartment, here's what eats the most electricity:</p>
<ol>
<li><strong>Air conditioning — 50–70%</strong> of your total bill</li>
<li><strong>Water heater — 10–15%</strong></li>
<li><strong>Refrigerator — 8–12%</strong></li>
<li><strong>Washing machine & dryer — 5–8%</strong></li>
<li><strong>Lighting — 5–10%</strong></li>
</ol>
<p>Everything else — TV, phone chargers, fans — is a rounding error.</p>

<h2>AC: The Big One</h2>
<p>Since AC dominates your bill, small changes here have the biggest impact:</p>
<ul>
<li><strong>Set to 24°C, not 18°C.</strong> Each degree lower costs roughly 6% more energy. 24°C is comfortable with a fan</li>
<li><strong>Use timer mode.</strong> Set the AC to turn off 2 hours after you fall asleep — your body temperature drops at night and you'll sleep fine</li>
<li><strong>Clean filters every 2 weeks.</strong> Dirty filters make the compressor work 15–20% harder</li>
<li><strong>Don't cool empty rooms.</strong> Turn off the AC when you leave a room for more than 30 minutes</li>
<li><strong>Use "dry" mode</strong> on humid but not extremely hot days — it uses less power than cooling mode</li>
</ul>

<h2>Water Heater</h2>
<ul>
<li><strong>Turn it off when not in use.</strong> There's no need to keep water hot 24/7. Turn it on 15 minutes before you need it</li>
<li><strong>Consider an instant water heater</strong> — they only heat water when the tap is open, using no standby power</li>
</ul>

<h2>Refrigerator</h2>
<ul>
<li><strong>Set the right temperature:</strong> 3–4°C for the fridge, -18°C for the freezer. Colder isn't better</li>
<li><strong>Keep it full but not packed</strong> — a well-stocked fridge retains cold better than an empty one</li>
<li><strong>Don't put hot food directly in the fridge</strong> — let it cool to room temperature first</li>
<li><strong>Clean the coils</strong> at the back every 6 months</li>
</ul>

<h2>Lighting</h2>
<ul>
<li><strong>Switch to LED bulbs.</strong> They use 75% less energy than incandescent bulbs and last years longer</li>
<li><strong>Use natural light</strong> during the day — open curtains instead of switching on lights</li>
<li><strong>Turn off lights when leaving a room.</strong> Simple, but people forget</li>
</ul>

<h2>Other Quick Wins</h2>
<ul>
<li><strong>Unplug chargers and devices</strong> when not in use — many draw standby power</li>
<li><strong>Wash clothes in cold water</strong> — modern detergents work fine without hot water</li>
<li><strong>Use a fan alongside the AC</strong> — ceiling fans or standing fans circulate cool air, letting you set the AC higher</li>
<li><strong>Close curtains during the day</strong> on sun-facing windows to reduce heat entering your home</li>
</ul>

<h2>Need Help Optimising?</h2>
<p>Sometimes the issue isn't habits — it's faulty wiring, an inefficient AC unit, or an old appliance drawing too much power. Easy Fix can do an energy check, service your AC, and identify any electrical issues driving up your bill.</p>
HTML,
                'is_published' => true,
                'published_at' => now()->subDays(17),
            ],

            // 9
            [
                'title' => 'How to Fix a Door That Won\'t Close Properly',
                'slug' => 'fix-door-that-wont-close-properly',
                'excerpt' => 'Doors that stick, sag, or won\'t latch are one of the most common household annoyances. Here\'s how to diagnose and fix the problem yourself.',
                'meta_title' => 'Fix a Sticking or Sagging Door | Easy Fix Malé',
                'meta_description' => 'Door won\'t close or latch properly? Learn how to diagnose and fix sticking, sagging, and misaligned doors with simple tools.',
                'content' => <<<'HTML'
<p>A door that sticks, swings open on its own, or won't latch is more than annoying — it's a daily frustration. The good news is that most door problems have straightforward fixes that take less than 30 minutes.</p>

<h2>Diagnose the Problem First</h2>
<p>Close the door slowly and watch where it makes contact or gets stuck:</p>
<ul>
<li><strong>Sticking at the top:</strong> The door is sagging — the top hinge may be loose</li>
<li><strong>Sticking at the bottom:</strong> The door has dropped — hinges may be worn</li>
<li><strong>Won't latch:</strong> The latch and strike plate are misaligned</li>
<li><strong>Sticking along the side:</strong> Humidity has caused the wood to swell (very common in Malé)</li>
</ul>

<h2>Fix 1: Tighten the Hinges</h2>
<p>This solves about 60% of door problems. Hinge screws work loose over time, especially on heavy doors.</p>
<ol>
<li>Open the door and check each hinge screw</li>
<li>Tighten any loose screws with a screwdriver</li>
<li>If a screw spins and won't tighten (the hole is stripped), remove it, fill the hole with a wooden toothpick and wood glue, let it dry, then re-drive the screw</li>
</ol>

<h2>Fix 2: Shim the Hinges</h2>
<p>If the door rubs at the top on the latch side, the top hinge may need to be recessed slightly more (or the bottom hinge less).</p>
<ul>
<li>Place a thin piece of cardboard behind the bottom hinge to push the door up</li>
<li>This adjusts the door angle without removing the entire frame</li>
</ul>

<h2>Fix 3: Adjust the Strike Plate</h2>
<p>If the latch doesn't align with the strike plate hole in the frame:</p>
<ol>
<li>Rub chalk or lipstick on the latch bolt</li>
<li>Close the door — the mark shows where the latch hits</li>
<li>If it's off by a few millimetres, file the strike plate opening to match</li>
<li>If it's off by more, remove and reposition the strike plate</li>
</ol>

<h2>Fix 4: Plane a Swollen Door</h2>
<p>In Malé's humidity, wooden doors absorb moisture and swell. If the door sticks along its edge:</p>
<ol>
<li>Mark the area where it sticks (close the door and look for the rub marks)</li>
<li>Remove the door from its hinges</li>
<li>Sand or plane the sticking edge — remove a small amount at a time</li>
<li>Seal the raw wood with paint or varnish to prevent future swelling</li>
</ol>

<h2>Fix 5: Door Swings Open or Closed on Its Own</h2>
<p>This means the door frame isn't plumb (perfectly vertical).</p>
<ul>
<li>If the door swings open: the top hinge sticks out too far — try tightening it or adding a shim behind the bottom hinge</li>
<li>If the door swings closed: the bottom hinge sticks out — reverse the approach</li>
<li>A quick fix: bend the hinge pin slightly by removing it and tapping it with a hammer</li>
</ul>

<h2>When to Call for Help</h2>
<p>If the door frame itself is warped, the wall has shifted, or you're dealing with a metal or glass door, it's best to call Easy Fix. Our technicians handle door adjustments, hinge replacements, and lock repairs across Malé every day.</p>
HTML,
                'is_published' => true,
                'published_at' => now()->subDays(20),
            ],

            // 10
            [
                'title' => 'Washing Machine Smells Bad? Here\'s How to Fix It',
                'slug' => 'washing-machine-smells-bad-how-to-fix',
                'excerpt' => 'If your washing machine smells musty or your clothes come out smelling worse than they went in, here\'s exactly what\'s causing it and how to fix it.',
                'meta_title' => 'Fix a Smelly Washing Machine | Easy Fix Malé',
                'meta_description' => 'Washing machine smells musty? Learn what causes the odour and how to deep clean your washer with simple household items.',
                'content' => <<<'HTML'
<p>You put dirty clothes in and they come out smelling... worse? A smelly washing machine is a common problem, especially in Malé's humidity. The culprit is almost always mould and bacteria thriving in warm, damp conditions inside the drum.</p>

<h2>Why It Happens</h2>
<p>Three things cause washing machine odour:</p>
<ol>
<li><strong>Using too much detergent</strong> — excess soap leaves a residue that bacteria feed on</li>
<li><strong>Keeping the door closed</strong> between washes — traps moisture inside</li>
<li><strong>Always washing on cold or low temperatures</strong> — never kills bacteria buildup</li>
</ol>
<p>In Malé's tropical humidity, the problem develops faster because nothing ever fully dries.</p>

<h2>Step 1: Run a Hot Empty Cycle</h2>
<p>Run your machine on the hottest setting, completely empty, with two cups of white vinegar in the drum. This kills bacteria and dissolves detergent residue.</p>

<h2>Step 2: Clean the Rubber Seal (Front Loaders)</h2>
<p>If you have a front-loading machine, pull back the rubber door gasket and look inside. You'll likely find black mould, hair clips, coins, and residue.</p>
<ul>
<li>Wipe the entire gasket with a cloth soaked in a 50/50 water-vinegar solution</li>
<li>Use an old toothbrush to get into the folds</li>
<li>For stubborn mould, use a paste of baking soda</li>
</ul>

<h2>Step 3: Clean the Detergent Drawer</h2>
<p>Pull out the detergent drawer completely (most slide out — press the release tab). You'll see buildup of old detergent and possibly mould.</p>
<ul>
<li>Soak the drawer in hot water with vinegar</li>
<li>Scrub all compartments with a brush</li>
<li>Clean the cavity where the drawer sits — use a toothbrush and spray bottle</li>
</ul>

<h2>Step 4: Clean the Filter</h2>
<p>Most front-loading machines have a small door at the bottom front. Behind it is a filter that catches coins, buttons, and debris.</p>
<ol>
<li>Place towels on the floor — water will come out</li>
<li>Open the cover and unscrew the filter slowly</li>
<li>Clean out whatever is inside (prepare to be disgusted)</li>
<li>Rinse the filter under running water</li>
<li>Replace and close the cover</li>
</ol>

<h2>Step 5: Run One More Hot Cycle</h2>
<p>After cleaning all the parts, run one final hot empty cycle — this time with half a cup of baking soda. It deodorises and rinses everything clean.</p>

<h2>Preventing the Smell from Coming Back</h2>
<ul>
<li><strong>Leave the door open</strong> after every wash — let the drum air out</li>
<li><strong>Use the right amount of detergent.</strong> More soap ≠ cleaner clothes. Follow the label</li>
<li><strong>Run a hot wash once a month</strong> — even just towels or bedsheets at 60°C kills bacteria</li>
<li><strong>Remove clothes immediately</strong> after the cycle ends — don't leave them sitting in the drum</li>
<li><strong>Wipe the rubber seal</strong> dry after each wash (front loaders)</li>
</ul>

<h2>Still Smelly?</h2>
<p>If the smell persists after a thorough clean, the issue might be in the drain hose or pump — bacteria can colonise areas you can't reach easily. Easy Fix can deep clean your washing machine or check the drainage system to solve the problem for good.</p>
HTML,
                'is_published' => true,
                'published_at' => now()->subDays(22),
            ],
        ];

        foreach ($posts as $post) {
            BlogPost::create($post);
        }
    }
}
