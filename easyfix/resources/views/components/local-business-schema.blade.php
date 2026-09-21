@php
    // Keep the public business facts in one server-rendered schema entity.
    $businessSchema = [
        '@context' => 'https://schema.org',
        '@type' => 'HomeAndConstructionBusiness',
        '@id' => url('/').'#localbusiness',
        'name' => 'EasyFix by Micronet',
        'alternateName' => 'EasyFix',
        'description' => 'Home repair and maintenance services in Greater Malé, Maldives, including AC service, plumbing, electrical, appliance repair, carpentry, cleaning, and more.',
        'url' => url('/'),
        'telephone' => '+9607779493',
        'email' => 'hello@micronet.mv',
        'image' => url('/og-image.png'),
        'logo' => url('/images/easyfix-logo.png'),
        'priceRange' => 'MVR',
        'currenciesAccepted' => 'MVR',
        'paymentAccepted' => 'Cash, Bank Transfer',
        'address' => [
            '@type' => 'PostalAddress',
            'streetAddress' => 'M. Ithaamuiyge, 10th Floor, Alimasmagu',
            'addressLocality' => 'Malé',
            'addressCountry' => 'MV',
        ],
        'geo' => [
            '@type' => 'GeoCoordinates',
            'latitude' => '4.1755',
            'longitude' => '73.5093',
        ],
        'areaServed' => [
            ['@type' => 'City', 'name' => 'Malé City'],
            ['@type' => 'City', 'name' => 'Hulhumalé'],
            ['@type' => 'City', 'name' => 'Villingili'],
        ],
        'openingHoursSpecification' => [
            [
                '@type' => 'OpeningHoursSpecification',
                'dayOfWeek' => ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Saturday', 'Sunday'],
                'opens' => '08:00',
                'closes' => '22:00',
            ],
        ],
        'sameAs' => [
            'https://www.facebook.com/easyfixmv',
            'https://www.instagram.com/easyfixmv',
        ],
        'hasOfferCatalog' => [
            '@type' => 'OfferCatalog',
            'name' => 'EasyFix Home Repair Services',
            'itemListElement' => [
                ['@type' => 'Offer', 'itemOffered' => ['@type' => 'Service', 'name' => 'AC Service and Aircon Repair', 'url' => route('services.show', 'ac-repair', absolute: true)]],
                ['@type' => 'Offer', 'itemOffered' => ['@type' => 'Service', 'name' => 'Appliance Repair', 'url' => route('services.show', 'appliance-repair', absolute: true)]],
                ['@type' => 'Offer', 'itemOffered' => ['@type' => 'Service', 'name' => 'Washing Machine Repair', 'url' => route('services.show', 'washing-machine-repair', absolute: true)]],
                ['@type' => 'Offer', 'itemOffered' => ['@type' => 'Service', 'name' => 'Oven Repair', 'url' => route('services.show', 'oven-repair', absolute: true)]],
                ['@type' => 'Offer', 'itemOffered' => ['@type' => 'Service', 'name' => 'Plumbing', 'url' => route('services.show', 'plumbing', absolute: true)]],
                ['@type' => 'Offer', 'itemOffered' => ['@type' => 'Service', 'name' => 'Electrical Repair', 'url' => route('services.show', 'electrical', absolute: true)]],
                ['@type' => 'Offer', 'itemOffered' => ['@type' => 'Service', 'name' => 'Carpentry', 'url' => route('services.show', 'carpentry', absolute: true)]],
                ['@type' => 'Offer', 'itemOffered' => ['@type' => 'Service', 'name' => 'Door and Lock Repair', 'url' => route('services.show', 'door-lock-repair', absolute: true)]],
                ['@type' => 'Offer', 'itemOffered' => ['@type' => 'Service', 'name' => 'Cleaning', 'url' => route('services.show', 'cleaning', absolute: true)]],
                ['@type' => 'Offer', 'itemOffered' => ['@type' => 'Service', 'name' => 'Small Moving', 'url' => route('services.show', 'small-moving', absolute: true)]],
                ['@type' => 'Offer', 'itemOffered' => ['@type' => 'Service', 'name' => 'On-Site Moto Mechanic', 'url' => route('services.show', 'moto-mechanic', absolute: true)]],
            ],
        ],
    ];
@endphp
<script type="application/ld+json">
{!! json_encode($businessSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) !!}
</script>
