<?php

namespace App\Http\Controllers\Frontend;

class AreaController extends Controller
{
    public function kettering() { return $this->areaPage('area-kettering'); }
    public function wellingborough() { return $this->areaPage('area-wellingborough'); }
    public function rushden() { return $this->areaPage('area-rushden'); }
    public function northampton() { return $this->areaPage('area-northampton'); }
    public function irthlingborough() { return $this->areaPage('area-irthlingborough'); }
    public function corby() { return $this->areaPage('area-corby'); }
    public function brackley() { return $this->areaPage('area-brackley'); }

    protected function areaPage(string $filename)
    {
        $view = 'website.Areas.' . $filename;

        if (!view()->exists($view)) {
            abort(404);
        }

        return view($view);
    }
}
