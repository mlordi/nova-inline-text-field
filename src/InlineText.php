<?php

namespace Outl1ne\NovaInlineTextField;

use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class InlineText extends Text
{
    public $component = 'inline-text-field';

    public function resolveAttribute($resource, string $attribute): mixed
    {
        $this->withMeta(['resourceId' => $resource->getKey()]);
        return parent::resolveAttribute($resource, $attribute);
    }

    public function resolve($resource, ?string $attribute = null): void
    {
        parent::resolve($resource, $attribute); // Ensure parent method is properly called
    
        /** @var NovaRequest $novaRequest */
        $novaRequest = app(NovaRequest::class); // Use app() correctly
    
        // Ensure we only modify the component for form requests
        if ($novaRequest->isFormRequest()) {
            $this->component = 'text-field';
        }
    }

    public function maxWidth(int|null $maxWidthPx = null)
    {
        return $this->withMeta(['maxWidth' => $maxWidthPx]);
    }
}
