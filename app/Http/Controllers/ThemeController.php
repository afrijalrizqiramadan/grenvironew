<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Theme;
use Illuminate\Support\Facades\Auth;
class ThemeController extends Controller
{
    public function setTheme(Request $request)
    {
      
        $theme = Auth::user()->theme->updateOrCreate(
            ['user_id' => Auth::id()],
            [
                'data_layout'         => $request->get('data-layout', 'vertical'),
                'data_topbar'         => $request->get('data-topbar', 'light'),
                'data_sidebar'        => $request->get('data-sidebar', 'dark'),
                'data_sidebar_size'   => $request->get('data-sidebar_size', 'lg'),
                'data_preloader'      => $request->get('data-preloader', 'disable'),
                'data_layout_width'   => $request->get('data-layout-width', 'fluid'),
                'data_layout_style'   => $request->get('data-layout-style', 'default'),
                'data_layout_position'=> $request->get('data-layout-position', 'fixed'),
            ]
        );

        return response()->json(['success' => true, 'message' => 'Theme updated successfully!']);
    }

    public function getTheme()
    {
        $theme = Auth::user()->theme;
        return response()->json(['theme' => $theme]);
    }
}
