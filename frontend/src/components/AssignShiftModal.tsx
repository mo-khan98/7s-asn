import { useState, useEffect } from 'react';
import type { Staff } from '../types/Staff';
import { staffService } from '../services/staffService';
import { shiftService } from '../services/shiftService';
import { Button } from './ui/button';
import { Dialog, DialogContent, DialogHeader, DialogTitle } from './ui/dialog';
import { Label } from './ui/label';
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from './ui/select';

interface AssignShiftModalProps {
  isOpen: boolean;
  onClose: () => void;
  shiftId: number;
  shiftRole: string;
  shiftDay: string;
  shiftTime: string;
  onAssigned: () => void;
}

export function AssignShiftModal({ 
  isOpen, 
  onClose, 
  shiftId, 
  shiftRole, 
  shiftDay, 
  shiftTime, 
  onAssigned 
}: AssignShiftModalProps) {
  const [staff, setStaff] = useState<Staff[]>([]);
  const [selectedStaffId, setSelectedStaffId] = useState<string>('');
  const [loading, setLoading] = useState(false);

  useEffect(() => {
    if (isOpen) {
      loadStaff();
    }
  }, [isOpen, shiftRole]);

  const loadStaff = async () => {
    try {
      const allStaff = await staffService.getAllStaff();
      // Filter staff by the required role
      const filteredStaff = allStaff.filter(s => s.role === shiftRole);
      setStaff(filteredStaff);
    } catch (error) {
      console.error('Error loading staff:', error);
    }
  };

  const handleAssign = async () => {
    if (!selectedStaffId) return;
    
    setLoading(true);
    try {
      await shiftService.assignShift({
        shift_id: shiftId,
        staff_id: parseInt(selectedStaffId)
      });
      onAssigned();
      onClose();
      setSelectedStaffId('');
    } catch (error) {
      console.error('Error assigning shift:', error);
    } finally {
      setLoading(false);
    }
  };

  return (
    <Dialog open={isOpen} onOpenChange={onClose}>
      <DialogContent>
        <DialogHeader>
          <DialogTitle>Assign Shift</DialogTitle>
        </DialogHeader>
        <div className="space-y-4">
          <div>
            <Label>Shift Details</Label>
            <p className="text-sm text-gray-600">
              {shiftDay} • {shiftTime} • {shiftRole}
            </p>
          </div>
          
          <div>
            <Label htmlFor="staff">Select Staff Member</Label>
            <Select value={selectedStaffId} onValueChange={setSelectedStaffId}>
              <SelectTrigger>
                <SelectValue placeholder="Choose a staff member" />
              </SelectTrigger>
              <SelectContent>
                {staff.map((member) => (
                  <SelectItem key={member.id} value={member.id.toString()}>
                    {member.name} ({member.phone})
                  </SelectItem>
                ))}
              </SelectContent>
            </Select>
          </div>
          
          <div className="flex justify-end space-x-2">
            <Button variant="outline" onClick={onClose}>
              Cancel
            </Button>
            <Button onClick={handleAssign} disabled={!selectedStaffId || loading}>
              {loading ? 'Assigning...' : 'Assign Shift'}
            </Button>
          </div>
        </div>
      </DialogContent>
    </Dialog>
  );
} 