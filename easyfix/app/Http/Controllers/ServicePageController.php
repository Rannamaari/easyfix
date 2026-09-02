<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class ServicePageController extends Controller
{
    /**
     * These pages are deliberately curated instead of generated from admin
     * categories, so their copy, URLs, and search intent remain consistent.
     */
    public static function pages(): array
    {
        return [
            'ac-repair' => [
                'name' => 'AC Repair',
                'title' => 'AC Repair & Aircon Services in Malé | EasyFix',
                'description' => 'Book AC repair and aircon services in Malé, Hulhumalé, and Villingili. Help for AC units that are not cooling, leaking, noisy, or showing error codes.',
                'icon' => 'sun',
                'intro' => 'When your aircon stops cooling in Maldives heat, you need clear, practical help. EasyFix connects you with local support for split AC troubleshooting, leaks, weak cooling, drainage issues, and common error codes.',
                'items' => ['AC not cooling or weak airflow', 'Water leaks and blocked drain issues', 'Noise, smells, and error-code troubleshooting', 'AC maintenance and service requests'],
                'faqs' => [
                    ['question' => 'Do you provide AC repair in Hulhumalé?', 'answer' => 'Yes. EasyFix accepts AC repair and aircon service requests in Malé City, Hulhumalé Phase 1 and 2, and Villingili.'],
                    ['question' => 'Can you quote an AC repair before visiting?', 'answer' => 'We can give a basic indication from the symptoms, but some AC faults need an inspection before we can provide an accurate quotation.'],
                ],
            ],
            'appliance-repair' => [
                'name' => 'Appliance Repair',
                'title' => 'Appliance Repair in Malé & Hulhumalé | EasyFix',
                'description' => 'Request appliance repair in Malé, Hulhumalé, and Villingili for fridges, microwaves, cookers, and everyday household appliances.',
                'icon' => 'cube-transparent',
                'intro' => 'A faulty home appliance can disrupt the whole day. Tell us what is happening and EasyFix will arrange support for common appliance faults, from kitchen equipment to small household appliances.',
                'items' => ['Fridge and freezer troubleshooting', 'Microwave and cooker issues', 'Power, heating, and control faults', 'Diagnosis before parts or larger repairs are approved'],
                'faqs' => [
                    ['question' => 'Which appliances can EasyFix help with?', 'answer' => 'We can review requests for fridges, microwaves, cookers, and many common household appliances. Share the make, model, and fault when you request service.'],
                    ['question' => 'Are spare parts included?', 'answer' => 'No. If parts or extra work are needed, we explain the cost and get your approval before proceeding.'],
                ],
            ],
            'washing-machine-repair' => [
                'name' => 'Washing Machine Repair',
                'title' => 'Washing Machine Repair in Malé & Hulhumalé | EasyFix',
                'description' => 'Need washing machine repair in Malé or Hulhumalé? Request help for machines that will not spin, drain, start, or complete a cycle.',
                'icon' => 'arrow-path',
                'intro' => 'Whether your washing machine will not drain, spin, start, or finish its cycle, EasyFix makes it simple to request local repair support. Include any error code and a short description so the technician can prepare.',
                'items' => ['Not spinning, draining, or starting', 'Water inlet and drainage issues', 'Error-code and cycle troubleshooting', 'Door, noise, and vibration problems'],
                'faqs' => [
                    ['question' => 'What details should I include for a washing machine repair?', 'answer' => 'Include the brand, model if known, the fault, any error code, and photos or a short video if possible.'],
                    ['question' => 'Do you serve washing machine repairs in Villingili?', 'answer' => 'Yes. EasyFix accepts requests across Malé City, Hulhumalé, and Villingili.'],
                ],
            ],
            'oven-repair' => [
                'name' => 'Oven Repair',
                'title' => 'Oven & Cooker Repair in Malé & Hulhumalé | EasyFix',
                'description' => 'Book oven and cooker repair in Malé, Hulhumalé, and Villingili. Get help for ovens that are not heating, tripping power, or have faulty controls.',
                'icon' => 'fire',
                'intro' => 'If your oven or cooker is not heating correctly, has a faulty control, or keeps tripping the power, EasyFix can help you request a diagnosis. We will explain the recommended work before any repair goes ahead.',
                'items' => ['Oven not heating or heating unevenly', 'Cooker switches and control issues', 'Power trips and electrical checks', 'Door, timer, and thermostat troubleshooting'],
                'faqs' => [
                    ['question' => 'Do you repair built-in ovens and cookers?', 'answer' => 'We can assess requests for built-in and freestanding ovens or cookers. Share a photo and the appliance details when you book.'],
                    ['question' => 'Is oven repair safe to attempt myself?', 'answer' => 'For electrical or heating faults, it is safer to switch the appliance off and request qualified support rather than dismantling it yourself.'],
                ],
            ],
            'electrical' => [
                'name' => 'Electrical Repair',
                'title' => 'Electrical Repair Services in Malé & Hulhumalé | EasyFix',
                'description' => 'Book electrical repair services in Malé, Hulhumalé, and Villingili for switches, sockets, lights, breakers, and minor wiring issues.',
                'icon' => 'bolt',
                'intro' => 'EasyFix helps with everyday electrical problems at homes and small workplaces. From a loose socket to lights that stop working, request support and describe the issue clearly for safer, faster coordination.',
                'items' => ['Switches, sockets, and light fittings', 'Minor wiring checks and fault finding', 'Circuit breaker and power-trip issues', 'Fan, fixture, and replacement requests'],
                'faqs' => [
                    ['question' => 'What should I do if an electrical issue feels unsafe?', 'answer' => 'Turn off power at the breaker if it is safe to do so, keep clear of damaged wiring or water, and call EasyFix for urgent guidance.'],
                    ['question' => 'Do you handle office electrical repairs?', 'answer' => 'Yes. EasyFix accepts electrical service requests from homes, offices, shops, and small commercial spaces.'],
                ],
            ],
            'plumbing' => [
                'name' => 'Plumbing',
                'title' => 'Plumbing Services in Malé & Hulhumalé | EasyFix',
                'description' => 'Book plumbing services in Malé, Hulhumalé, and Villingili for leaking taps, blocked drains, toilets, pipes, and small replacements.',
                'icon' => 'wrench-screwdriver',
                'intro' => 'Leaks, blocked drains, and faulty taps should not have to wait. EasyFix helps you request local plumbing support for common home and office plumbing issues across Greater Malé.',
                'items' => ['Leaking taps, sinks, and pipes', 'Blocked drains and slow drainage', 'Toilet and flush repair requests', 'Small fittings and replacement work'],
                'faqs' => [
                    ['question' => 'Can you help with a leaking pipe urgently?', 'answer' => 'Yes. Mark urgent support when submitting your plumbing request and explain where the leak is so the team can prioritise the earliest available slot.'],
                    ['question' => 'Do you provide plumbing in Hulhumalé Phase 2?', 'answer' => 'Yes. EasyFix serves Hulhumalé Phase 1 and Phase 2, as well as Malé City and Villingili.'],
                ],
            ],
            'carpentry' => [
                'name' => 'Carpentry',
                'title' => 'Carpentry Services in Malé & Hulhumalé | EasyFix',
                'description' => 'Request carpentry services in Malé and Hulhumalé for shelves, cabinets, door adjustments, fittings, and light woodwork jobs.',
                'icon' => 'home-modern',
                'intro' => 'EasyFix now accepts carpentry requests for practical home and office improvements. Share the measurements, photos, and the outcome you need, and we will help arrange the right local support.',
                'items' => ['Shelves, cabinets, and small fittings', 'Door alignment, hinges, and adjustments', 'Light woodwork and repair requests', 'Furniture assembly and wall-mounted items'],
                'faqs' => [
                    ['question' => 'Can I request custom carpentry work?', 'answer' => 'Yes. Add photos, dimensions, and a clear description so we can assess the scope before confirming availability.'],
                    ['question' => 'Is carpentry available now?', 'answer' => 'Yes. Carpentry is currently available during EasyFix soft opening, with limited staff and slots.'],
                ],
            ],
            'door-lock-repair' => [
                'name' => 'Door & Lock Repair',
                'title' => 'Door & Lock Repair in Malé & Hulhumalé | EasyFix',
                'description' => 'Book door and lock repair in Malé, Hulhumalé, and Villingili for faulty locks, handles, hinges, door alignment, and replacement fittings.',
                'icon' => 'key',
                'intro' => 'A faulty lock, loose handle, or door that will not close properly is stressful and inconvenient. EasyFix helps you request repair support for common door, hinge, handle, and lock problems.',
                'items' => ['Door lock and handle problems', 'Hinges, alignment, and closing issues', 'Latch and fitting replacements', 'Small door repair and adjustment work'],
                'faqs' => [
                    ['question' => 'Can I request help for a locked door?', 'answer' => 'Yes. Choose urgent support if you need faster help, and explain the situation clearly when submitting your request.'],
                    ['question' => 'Can you replace a damaged door handle?', 'answer' => 'Yes. We can assess handle and lock replacement requests. Any required hardware is quoted before work begins.'],
                ],
            ],
            'cleaning' => [
                'name' => 'Cleaning',
                'title' => 'Home & Deep Cleaning in Malé & Hulhumalé | EasyFix',
                'description' => 'Book home, deep, move-out, and kitchen or bathroom cleaning in Malé, Hulhumalé, and Villingili with EasyFix.',
                'icon' => 'sparkles',
                'intro' => 'EasyFix offers cleaning support for homes and small workplaces, including deep cleaning, move-out cleaning, and kitchen or bathroom refreshes. Tell us about the space and the level of cleaning you need.',
                'items' => ['Home and apartment cleaning', 'Deep cleaning and move-out cleaning', 'Kitchen and bathroom refreshes', 'Office and small workplace cleaning'],
                'faqs' => [
                    ['question' => 'Can I request a one-time deep clean?', 'answer' => 'Yes. Tell us the size of the space, the areas needing attention, and your preferred date when you request service.'],
                    ['question' => 'Is cleaning available in Hulhumalé?', 'answer' => 'Yes. Cleaning requests are available in Malé City, Hulhumalé, and Villingili, subject to staff availability.'],
                ],
            ],
            'small-moving' => [
                'name' => 'Small Moving',
                'title' => 'Small Moving Service in Malé & Hulhumalé | EasyFix',
                'description' => 'Request small moving help in Malé and Hulhumalé for furniture, appliances, and smaller loads within the Greater Malé area.',
                'icon' => 'cube',
                'intro' => 'Need help moving a few items, furniture, or an appliance within Greater Malé? EasyFix accepts small moving requests and will confirm the practical details before arranging support.',
                'items' => ['Furniture and appliance moving', 'Small household loads', 'Pickup and drop-off coordination', 'Help for moves within Greater Malé'],
                'faqs' => [
                    ['question' => 'What counts as a small moving request?', 'answer' => 'Small moving is suitable for limited furniture, appliances, and smaller household loads. Add a list and photos so we can assess the job.'],
                    ['question' => 'Can you move items between Malé and Hulhumalé?', 'answer' => 'Yes. Tell us both locations, the item list, and any access details when you request service.'],
                ],
            ],
            'moto-mechanic' => [
                'name' => 'Moto Mechanic',
                'title' => 'On-Site Moto Mechanic in Malé & Hulhumalé | EasyFix',
                'description' => 'Request an on-site moto mechanic in Malé and Hulhumalé for motorcycle troubleshooting, tyre changes, batteries, brakes, and basic service support.',
                'icon' => 'wrench',
                'intro' => 'EasyFix offers on-site moto mechanic support for common motorcycle issues in Greater Malé. Tell us the bike model, location, and symptoms so we can assess the right assistance.',
                'items' => ['Motorcycle troubleshooting and basic checks', 'Tyre, battery, and brake service requests', 'Oil-change and minor maintenance support', 'On-site help in Greater Malé where available'],
                'faqs' => [
                    ['question' => 'Can EasyFix send a moto mechanic to my location?', 'answer' => 'Yes. Share your exact location, motorcycle details, and the issue when requesting on-site support. Availability depends on the job and technician schedule.'],
                    ['question' => 'Do you supply motorcycle spare parts?', 'answer' => 'If a part is needed, we will confirm availability and cost with you before any replacement is carried out.'],
                ],
            ],
        ];
    }

    public function index(): View
    {
        return view('services.index', ['services' => self::pages()]);
    }

    public function show(string $service): View
    {
        abort_unless(isset(self::pages()[$service]), 404);

        return view('services.show', [
            'service' => self::pages()[$service],
            'slug' => $service,
        ]);
    }
}
