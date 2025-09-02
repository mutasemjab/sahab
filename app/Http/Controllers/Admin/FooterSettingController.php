<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FooterSetting;
use Illuminate\Http\Request;

class FooterSettingController extends Controller
{
    /**
     * Display footer settings management page
     */
    public function index()
    {
        $aboutLinks = FooterSetting::where('section', 'about_municipality')
                                  ->orderBy('order')
                                  ->get();
        
        $quickLinks = FooterSetting::where('section', 'quick_links')
                                  ->orderBy('order') 
                                  ->get();
        
        return view('admin.footer-settings.index', compact('aboutLinks', 'quickLinks'));
    }

    /**
     * Update footer settings
     */
    public function update(Request $request)
    {
        $request->validate([
            'settings' => 'required|array',
            'settings.*.is_active' => 'sometimes|boolean',
            'settings.*.order' => 'sometimes|integer|min:1'
        ]);

        try {
            foreach ($request->settings as $id => $data) {
                $footerSetting = FooterSetting::findOrFail($id);
                
                // Handle checkbox (when unchecked, it's not sent in request)
                $data['is_active'] = isset($data['is_active']) ? 1 : 0;
                
                $footerSetting->update($data);
            }

            return redirect()->back()->with('success', __('messages.footer_settings_updated_successfully'));
            
        } catch (\Exception $e) {
            return redirect()->back()->with('error', __('messages.error_updating_footer_settings'));
        }
    }
}