<?php

declare(strict_types=1);

namespace Tests\Api;

use Wati\Api\ResponseData;

describe('ResponseData', function (): void {
    describe('hasMore', function (): void {
        it('returns true when nextPage is not null', function (): void {
            $response = new class extends ResponseData
            {
                public ?string $nextPage = 'https://api.example.com?page=2';
            };

            expect($response->hasMore())->toBeTrue();
        });

        it('returns false when nextPage is null', function (): void {
            $response = new class extends ResponseData
            {
                public ?string $nextPage = null;
            };

            expect($response->hasMore())->toBeFalse();
        });

        it('returns false when nextPage property does not exist', function (): void {
            $response = new class extends ResponseData {};

            expect($response->hasMore())->toBeFalse();
        });
    });

    describe('isSuccessful', function (): void {
        it('returns true when result is success', function (): void {
            $response = new class extends ResponseData
            {
                public string $result = 'success';
            };

            expect($response->isSuccessful())->toBeTrue();
        });

        it('returns false when result is not success', function (): void {
            $response = new class extends ResponseData
            {
                public string $result = 'error';
            };

            expect($response->isSuccessful())->toBeFalse();
        });

        it('returns false when result property does not exist', function (): void {
            $response = new class extends ResponseData {};

            expect($response->isSuccessful())->toBeFalse();
        });
    });
});
